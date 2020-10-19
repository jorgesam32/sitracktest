# Lumen PHP Framework

[![Build Status](https://travis-ci.org/laravel/lumen-framework.svg)](https://travis-ci.org/laravel/lumen-framework)
[![Total Downloads](https://poser.pugx.org/laravel/lumen-framework/d/total.svg)](https://packagist.org/packages/laravel/lumen-framework)
[![Latest Stable Version](https://poser.pugx.org/laravel/lumen-framework/v/stable.svg)](https://packagist.org/packages/laravel/lumen-framework)
[![License](https://poser.pugx.org/laravel/lumen-framework/license.svg)](https://packagist.org/packages/laravel/lumen-framework)

##***Código realizado en PHP con framework Lumen***
##*Función que a partir de la recepción de un Json por medio de POST o GET que contenga un array A de numeros enteros y un numero X entero*
##*Determine la mayor cantidad de los pares de valores de A  de posibles sumas iguales a X*
##ejemplo de Json correcto a recibir:
##*
##{
##    "A":[-2,-3,-1,3,4,5,2,0],
##    "X": 2
##}
##*
##En este caso devolvera un Json como el siguiente:
##{
##    "resultado": 4
##}
##Ya que para el ejemplo los posibles pares cuya suma es igual a 2, son [-2,4][-3,5][-1,3][2,0]
##*Será validado, el formato del mensaje sea Json*
##*Donde "A", debe ser un arreglo solo de enteros con n cantidad de valores entre -1000 y 1000*
##*Se valida que X sea un numero entero en el intervalo [0 .. 1000]*
##***Para el llamado de la función se debe apuntar al metodo suma***
##*Ejemplo*
##http://host:puerto/suma
