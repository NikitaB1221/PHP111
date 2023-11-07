<?php

include_once "ApiController.php" ;

class CartController extends ApiController {

    private function get_active_card( $id_user ) {
        $db = $this->get_db();
        $sql = "SELECT * FROM shop_cart_order WHERE `id_user` = {$id_user}
                AND `order_dt` IS NULL AND `delete_dt` IS NULL" ;
        try {
            return $db->query( $sql )->fetch() ;            
        }
        catch( PDOException $ex ) {
            $this->log_error( __METHOD__ . "#" . __LINE__ . $ex->getMessage() . " {$sql}" ) ;
            $this->send_error( 500 ) ;
        }
    }

	protected function do_get() {
		global $_CONTEXT ;
		if( isset( $_CONTEXT[ 'user' ] ) ) {
            $cart = $this->get_active_card( $_CONTEXT[ 'user' ][ 'id' ] ) ;            
            $_CONTEXT[ 'cart' ] = $cart;
            if( ! empty( $cart ) ) {
                // Одержуємо всі позиції по замовленню
                $sql = "SELECT * FROM shop_cart_item WHERE id_cart = {$cart['id']}" ;
                try {
                    $_CONTEXT[ 'orders' ] = $this->get_db()->query($sql)->fetchAll() ;
                }
                catch( PDOException $ex ) {
                    $this->log_error( __METHOD__ . "#" . __LINE__ . $ex->getMessage() . " {$sql}" ) ;
                    $this->send_error( 500 ) ;
                }
            }
        }	
		
		$page =  'CartView.php' ;
		include '_layout.php' ;
	}

    protected function do_post() {
		global $_CONTEXT ;
        if( empty( $_GET[ 'id-product' ] ) ) {
            $this->send_error( 400, "'id-product' parameter required" ) ;
        }
        $id_product = $_GET[ 'id-product' ] ;

        $db = $this->get_db();
        if( empty( $_CONTEXT[ 'user' ] ) ) {
            $this->send_error( 401 ) ;
        }
        $id_user = $_CONTEXT[ 'user' ][ 'id' ] ;

        $cart = $this->get_active_card( $id_user ) ;
        if( empty( $cart ) ) {  // немає кошику - створюємо його 
            /* Задача: створити order, одержати його id 
                і з цим id та id-product сформувати item.
               Проблема: як дізнатись id створеного order
               Рішення: id формується у коді (а не у БД)
               Нова пробема: як згенерувати id, якого гарантовано немає у БД?
               Рішення: запитати його у самої БД
               Підсумок: 
                - запитуємо id у БД
                - створюємо з ним order
                - з ним же + id-product створюємо item  */
            try {
                $id_order = $this->get_db_identity() ;
                $db->query( "INSERT INTO shop_cart_order(`id`, `id_user`)
                    VALUES( {$id_order}, {$id_user} ) " ) ;
                $db->query( "INSERT INTO shop_cart_item(`id_cart`, `id_product`)
                    VALUES( {$id_order}, {$id_product} ) " ) ;
            }
            catch( PDOException $ex ) {
                $this->log_error( __METHOD__ . "#" . __LINE__ . $ex->getMessage() ) ;
                $this->send_error( 500 ) ;
            }
        }
        else {  // є кошик

        }
    }
    // Повертає id, що гарантовано є вільним
    private function get_db_identity() {
        return $this
            ->get_db()
            ->query("SELECT UUID_SHORT()")
            ->fetch( PDO::FETCH_NUM )
            [0] ;
    }

}