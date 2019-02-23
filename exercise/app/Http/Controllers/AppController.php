<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppController extends Controller
{
    public function product_index(){
        if(empty(session('obj'))){
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_URL, 'http://www.mocky.io/v2/5c4982d83200004b000b588c');
            $result = curl_exec($ch);
            curl_close($ch);
            $obj = json_decode($result);
            session(['obj' => $obj]);
        }
        
        return view('welcome');
    }

    public function coin_process(int $coin){
        session()->push('coin', $coin);

        return redirect(route('product.index'))
        ->with('status', 'Add Coin '. $coin. ' Bath Success')
        ->with('alert', 'success');
    }

    public function product_process(int $id){
        foreach(session('obj')->data as $k => $v){
            if($v->id == $id){
                $status = '';
                $alert = '';
                $txtCoin = '';
                foreach(session('coin') as $keyCoin => $vCoin){
                    $txtCoin.= $vCoin. ' Bath,';
                }
                $status = "User insert ". $txtCoin. " coins and select ". $v->name;
                if($v->price <= array_sum(session('coin'))){
                    $alert = "success";
                    $total = (int)array_sum(session('coin'))- (int)$v->price;
                    $status.= " and you have refund total ". $total. " Bath";
                    if($v->in_stock == false){
                        $alert = "danger";
                        $status.= " but can't select it because this product isn't available";
                    }else{
                        session()->pull('coin', 'default');
                    }
                }else{
                    $alert = "danger";
                    $status.= " but can't select it because user don't have enough money";
                }

                return redirect(route('product.index'))
                    ->with('status', $status)
                    ->with('alert', $alert);
            }
        }

    }

    public function coin_refund(){
        $txtCoin = '';
        foreach(session('coin') as $keyCoin => $vCoin){
            $txtCoin.= $vCoin. ' Bath,';
        }
        $status = "User insert ". $txtCoin. " but user would like to refund";
        session()->pull('coin', 'default');

        return redirect(route('product.index'))
            ->with('status', $status)
            ->with('alert', 'warning');
    }
}


