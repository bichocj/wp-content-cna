<?php 
/********************************************************************
START A NEW ADDING POINT FOR API JSON
********************************************************************/
/**
* Trying API CALLBACKS
*/
class Slug_Custom_Route extends WP_REST_Controller {

	public function register_routes() {
			$mainUpRoot = 'mpollqst';
			$verjson = 'v2';
			$pollroute = 'cna-poll/'.$verjson;
			register_rest_route($pollroute,'/'.$mainUpRoot, array(
				array(
					'methods' => WP_REST_Server::READABLE,
					'callback'	=> array( $this, 'get_poll_qst' ),
				)
			));
		/*add_action( 'rest_api_init', function () {
			$mainUpRoot = 'mpollnsw';
			$verjson = 'v2';
			$pollroute = 'cna-poll/'.$verjson;
			register_rest_route($pollroute,'/'.$mainUpRoot, array(
				'methods' => WP_REST_Server::READABLE,
				'callback'	=> 'get_poll_nsw',
			));
		} );
		add_action( 'rest_api_init', function () {
			$mainUpRoot = 'mpollp';
			$verjson = 'v2';
			$pollroute = 'cna-poll/'.$verjson;
			register_rest_route($pollroute,'/'.$mainUpRoot, array(
				'methods' => WP_REST_Server::READABLE,
				'callback'	=> 'get_poll_users',
			));
		} );*/
			$mainUpdateRoot = 'mpollsnd';
			register_rest_route($pollroute,'/'.$mainUpdateRoot, array(
				'methods' => WP_REST_Server::EDITABLE,
				'callback'	=> array( $this, 'update_poll_qst' ),
				'permission_callback' => array( $this, 'update_item_permissions_check' ),
				'args'            => $this->get_endpoint_args_for_item_schema( false ),
			));
	}

	public function get_poll_qst( $request ) {
		global $wpdb;
		$datapollqst = $wpdb->get_results( "SELECT * FROM ".$wpdb->prefix."pollsq ORDER BY pollq_id DESC
	LIMIT 1");
		$datapollid = $datapollqst[0]->pollq_id;
		$datapollans = $wpdb->get_results( "SELECT * FROM ".$wpdb->prefix."pollsa WHERE polla_qid = ".$datapollid);
		return array($datapollqst,$datapollans);
	}/*
	function get_poll_nsw( $request ) {
		global $wpdb;
		$datapolls = $wpdb->get_results( "SELECT * FROM ".$wpdb->prefix."pollsa");

		if ( empty( $datapolls ) ) {
			return null;
		}

		return $datapolls;
	}
	function get_poll_users( $request ) {
		global $wpdb;

		$datapolls = $wpdb->get_results( "SELECT * FROM ".$wpdb->prefix."pollsip");

		if ( empty( $datapolls ) ) {
			return null;
		}
		return $datapolls;
	}*/
	public function update_poll_qst() {
		global $wpdb;
		
		$pollq_id = $_POST["lidpoll"];
		$polla_aid = $_POST["laidpoll"];
		$pollip_ip = $_POST["lipusrpoll"];
		$pollip_host = $_POST["lhostusrpoll"];
		$registered = 'Registered';
		$failed = 'Failed';

		if ($pollq_id && $polla_aid && $pollip_ip && $pollip_host) {
			/******************************************
			OBTENER DATOS
			******************************************/
			$pollq_totalvotes = $wpdb->get_var( $wpdb->prepare("SELECT pollq_totalvotes FROM ".$wpdb->prefix."pollsq WHERE pollq_id = %s", $pollq_id));
			$pollq_totalvotes = ++$pollq_totalvotes;
			$pollq_totalvoters = $wpdb->get_var( $wpdb->prepare("SELECT pollq_totalvoters FROM ".$wpdb->prefix."pollsq WHERE pollq_id = %s", $pollq_id));
			$pollq_totalvoters = ++$pollq_totalvoters;
			$polla_votes = $wpdb->get_var( $wpdb->prepare("SELECT polla_votes FROM ".$wpdb->prefix."pollsa WHERE polla_aid = %s AND polla_qid = %d", $polla_aid,$pollq_id));
			$polla_votes = ++$polla_votes;
			/******************************************
			ACTUALIZAR DATOS
			******************************************/
			$questupdate = $wpdb->query("UPDATE ".$wpdb->prefix."pollsq SET pollq_totalvotes = ".$pollq_totalvotes.", pollq_totalvoters = ".$pollq_totalvoters." WHERE pollq_id = ".$pollq_id."");
			$answerupdate = $wpdb->query("UPDATE ".$wpdb->prefix."pollsa SET polla_votes = ".$polla_votes." WHERE polla_aid = ".$polla_aid." AND polla_qid = ".$pollq_id."");

			/******************************************
			REGISTRAR DATOS
			******************************************/
			$now = new DateTime();
			$pollip_timestamp = $now->getTimestamp();
			$userregister = $wpdb->query($wpdb->prepare("INSERT INTO ".$wpdb->prefix."pollsip (pollip_id, pollip_qid, pollip_aid, pollip_ip, pollip_host,pollip_timestamp,pollip_user,pollip_userid ) VALUES ( %d, %s, %s, %s, %s, %s, %s, %s )", 'DEFAULT', $pollq_id, $polla_aid, $pollip_ip, $pollip_host, $pollip_timestamp, 'Guest', 0));
			return array($registered,$pollq_id,$polla_aid,$pollip_ip,$pollip_host);
		}
		else
		{
			return array($failed,$pollq_id,$polla_aid,$pollip_ip,$pollip_host);
		}
	}
	public function update_item_permissions_check( $request ) {
		return $this->create_item_permissions_check( $request );
	}
}

?>