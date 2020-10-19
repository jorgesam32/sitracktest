<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
class sumaController extends Controller
{
    /**
    * función para validar el contenido del arreglo recibido
    *@param $ArrayOfIntenegers se valida sea un arreglo de enteros con valores entre -1000 y 1000
    *@return Boolean true o false.
    */
    public function ValidateArray($ArrayOfIntegers){
        if (!is_array($ArrayOfIntegers)){//valido si es un arreglo
            return false;
	    }
	    foreach ($ArrayOfIntegers as $ArrayToValidate){
		    if ($ArrayToValidate < -1000 || $ArrayToValidate > 1000 ){//verifico minimo y maximo valor posible
			    return false;
		    }
		    if (!is_int($ArrayToValidate)){//verifico que el contenido solo sea enteros.
                return false;
		    }
	    }
	    return true;
    }
    /**
    * Función devuelve maxima cantidad de pares distintos a partir de un array de enteros donde la suma de los pares es
    * un segundo valor recibido como parametro
    *@param $JsonWithArrayAndResult json que contiene un array y resultado esperado de la suma de pares de enteros del array
    *@return json con formato "resultado":"entero cantidad de pares distintos".
    */
    public function suma(Request $JsonWithArrayAndResult){
        if ($JsonWithArrayAndResult->isJson()){
            $RequestContent=$JsonWithArrayAndResult->json()->all();
            if (empty($RequestContent)){//verifico json correcto
                return response()->json(['error'=>'JSON incorecto'], $status=203);
            }
            else{
                if (array_key_exists('A',$RequestContent)){
                    $ArrayOfIntegers=($RequestContent['A']);
                }
                else {
                    return response()->json(['error'=>'El JSON debe contener un arreglo como parametro A'], 'status:203');
                };
                if (array_key_exists('X',$RequestContent)){
                    $ExpectedSum=($RequestContent['X']);
                }
                else {
                    return response()->json(['error'=>'El JSON debe contener un entero como parametro X'], $status=203);
                };
                $NumberOfPairs = 0;//cantidad de pares encontrados cuya suma es igual al parametro X
                if ($this->ValidateArray($ArrayOfIntegers)){
                     if (is_int($ExpectedSum)&&$ExpectedSum<=1000&&$ExpectedSum>=0){
                        $ArrayPairValuesSum = 0;
                        sort($ArrayOfIntegers);// reordeno el array recibido, ya validado.
                        $ArrayNeatAscending = $ArrayOfIntegers;
                        $ArrayNeatAscendingSize = count($ArrayNeatAscending);
                        $PostionInArray = 0;
                        $EqualValues=0;
                        $LastValueFirtsRound=null;
                        $LastValueSecondRound=null;
                        foreach($ArrayOfIntegers as $ValueInFirtsRound){//Primer recorrido del arreglo
                            if ($LastValueFirtsRound!=$ValueInFirtsRound) {
                                for ($PositionInLoop = $PostionInArray; $PositionInLoop < $ArrayNeatAscendingSize; $PositionInLoop++) {
                                    //segundo recorrido para validar la suma
                                    $ValueInSecondRound=$ArrayNeatAscending[$PositionInLoop];
                                    if ($LastValueSecondRound!=$ValueInSecondRound) {
                                        $ArrayPairValuesSum = $ValueInFirtsRound+$ValueInSecondRound;
                                        if ($ArrayPairValuesSum==$ExpectedSum && $ValueInFirtsRound!=$ValueInSecondRound&&$EqualValues==0) {
                                            $NumberOfPairs = $NumberOfPairs+1;
                                        }
                                        if ($ArrayPairValuesSum==$ExpectedSum && $ValueInFirtsRound==$ValueInSecondRound&&$EqualValues==0) {
                                            $NumberOfPairs = $NumberOfPairs+1;
                                            $EqualValues=1;
                                        }
                                    }
                                    $LastValueSecondRound=$ValueInSecondRound;
                                }
                                $PostionInArray = $PostionInArray+1;
                            }
                            $LastValueFirtsRound=$ValueInFirtsRound;
                        }
                        return response()->json(['resultado'=>$NumberOfPairs], $status=200);
                    }
                    else{
                        return response()->json(['error'=>'El parametro X debe ser un entero entre 0 y 1000'], $status=203);
                    }
                }
                else {
                    return response()->json(['error'=>'El parametro A debe ser un array con enteros entre -1000 y 1000'], $status=203);
                }

            }
        }
        else{
            return response()->json(['error'=>'No se recibio un JSON'], $status=203);
        }

    }


}
