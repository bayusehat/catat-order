<?php

namespace App\Observers;
use App\DetailPesan;
use App\Pesan;

class DetailObeservers
{
   private function generateTotal($detailPesan){
       $id_penjualan = $detailPesan->id_penjualan;
       $detail_penjualan = DetailPesan::where('id_penjualan',$id_penjualan)->get();

       $total = $detail_penjualan->sum(function($i){
            return $i->subtotal;
       });

       Pesan::where('id_penjualan',$id_penjualan)->update([
           'total' => $total
       ]);
   }

   public function created(DetailPesan $detailPesan)
    {
        //PANGGIL METHOD BARU TERSEBUT
        $this->generateTotal($detailPesan);
    }

    public function updated(DetailPesan $detailPesan)
    {
        //PANGGIL METHOD BARU TERSEBUT
        $this->generateTotal($detailPesan);
    }

    public function deleted(DetailPesan $detailPesan)
    {
        //PANGGIL METHOD BARU TERSEBUT
        $this->generateTotal($detailPesan);
    }
}
