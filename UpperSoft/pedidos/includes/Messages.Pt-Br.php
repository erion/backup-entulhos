<?php

 /**
 * IMMOPHP - Input Validation Classes for PHP
 *
 * LICENSE:
 * 
 * Copyright (c) 2007, Uilton Dutra <uiltondutra@gmail.com>
 *  
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions
 * are met:
 *
 *    * Redistributions of source code must retain the above copyright
 *      notice, this list of conditions and the following disclaimer.
 *    * Redistributions in binary form must reproduce the above copyright
 *      notice, this list of conditions and the following disclaimer in the 
 *      documentation and/or other materials provided with the distribution.
 *    * The names of the authors may not be used to endorse or promote products 
 *      derived from this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS
 * IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO,
 * THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR
 * PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR
 * CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL,
 * EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO,
 * PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR
 * PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY
 * OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
 * NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
 * SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * @package    ImmoPHP
 * @author     Uilton Dutra <uilon@funcionalti.com.br>
 * @license    http://www.gnu.org/licenses/gpl.txt
 * @link       http://code.google.com/p/immophp/
 */

$ErrorMessages = array();
$ErrorMessages['Required']     = "<strong>%s</strong> é requirido mas não existe.";
$ErrorMessages['NotNull']      = "O campo <strong>%s</strong> não pode ser nulo.";
$ErrorMessages['Matches']      = "O campo <strong>%s</strong> deve ser igual ao campo <strong>%s</strong>.";
$ErrorMessages['MinLength']    = "<strong>%s</strong>: MinLength error.";
$ErrorMessages['MaxLength']    = "<strong>%s</strong>: MaxLength error.";
$ErrorMessages['Length']       = "<strong>%s</strong>: Length error.";
$ErrorMessages['Alpha']        = "<strong>%s</strong> must contain only alpha characters.";
$ErrorMessages['AlphaNumeric'] = "<strong>%s</strong> must contain only alpha-numeric characters.";
$ErrorMessages['Numeric']      = "<strong>%s</strong> must contain only alpha-numeric characters.";
$ErrorMessages['ValidaData']   = "Data de entrega deve ser maior que data do pedido.";
$ErrorMessages['VerificaSenha']= "Senha não confere, atenção ao digitá-la. Este é um dado importante.";

?>
