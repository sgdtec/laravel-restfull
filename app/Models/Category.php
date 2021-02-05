<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

   //Campos autorizados para inserir no banco
   protected $fillable = ['name'];

   //Busca de Category pelo name 
   public function getResults($name = null) 
   {
       if (!$name) {
           return $this->get();
       }

       return $this->where('name', 'LIKE', "%{$name}%")->get();
   }

   //Retorna todos os produtos um pra muitos
   public function products() {
       return $this->hasMany(Product::class);
   }

}
