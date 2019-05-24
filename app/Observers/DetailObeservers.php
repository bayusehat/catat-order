<?php

namespace App\Observers;
use App\DetailPesan;
use App\Pesan;

class DetailObeservers
{
   private function generateTotal($detailPesan){
       $id_penjualan = $detailPesan->id_penjualan;
       $detail_penjualan = DetailPesan::where('id_penjualan',$id_penjualan)->sum('subtotal');
       Pesan::where('id_penjualan',$id_penjualan)->update([
           'total' => $detail_penjualan
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
