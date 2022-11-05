<?php
namespace App\Services;

use Illuminate\Http\Request;

class ProductQuery{
    //Aqui pones que columnas se pueden usar en la api para filtrar.
    protected $safeParams = [
        'id' => ['eq']
    ];

    /* protected $columnMap = [
        'postalCode' = 'postal_code'
    ]; */

    //Operadores que usaremos que sean los que utiliza Eloquent
    protected $operatorMap = [
        'eq' => '='
    ];

    //Aqui el f
    public function transform(Request $request){
        $eloQuery = [];

        foreach($this->safeParams as $parm => $operators){
            $query = $request->query($parm);
            if(!isset($query)){
                continue;
            }

            /* $column = $this->columnMap[$param] ?? $parm; */
            $column = $parm;

            foreach($operators as $operator){
                if(isset($query[$operator])){
                    $eloQuery[] = [$column, $this->operatorMap[$operator], $query[$operator]];
                }
            }
        }


        return $eloQuery;
    }


}
