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

class ServerValidator {

   var $_Array         = array();
   var $_Rules         = array();
   var $_Fields        = array();
   var $_Language      = 'Pt-Br';
   var $_ErrorList     = array();
   var $_ErrorPrefix   = "<p class=\"Error\">";
   var $_ErrorSuffix   = "</p>\n";
   var $_ErrorMessages = array();

   function ServerValidator($ArrayToValidate = '')
   {    
      $this->_Array = $ArrayToValidate;
      $this->setLanguage($this->_Language);
   }

   function SetLanguage($Language)
   {
      $LanguageFile = pathinfo(__FILE__);
      $LanguageFile = $LanguageFile['dirname'].'/'.'Messages.'.$Language.'.php';
      if(file_exists($LanguageFile))
      {
         include($LanguageFile);
         $this->_Language = $Language;
         $this->_ErrorMessages = $ErrorMessages;
      }
      else
      {
         return false;
      }
      return true;
   }

   function setFields($Fields = '')
   {    
      $this->_Fields = $Fields;
   }

   function setRules($Rules = '')
   {    
      $this->_Rules = $Rules;
   }
   
   function getError($Field) {
      if (isset($this->_ErrorList[$Field]))
      {
         return ($this->_ErrorPrefix.$this->_ErrorList[$Field].$this->_ErrorSuffix);
      }
      else
      {
         return '';
      }
   }
   
   function getErrorList() {
      if (count($this->_ErrorList)>0)
      {
         $output = "<ul id=\"ErrorList\">\n";
         foreach ($this->_ErrorList as $ErrorMessage)
         {
            $output .= "<li>".$ErrorMessage."</li>\n";
         }
         $output .= "</ul>\n";
         return $output;
      }
      else
      {
         return '';
      }
   }

   function Run()
   {    
      if (count($this->_Array) == 0 && count($this->_Rules) == 0)
      {        
         return FALSE;
      }
      foreach ($this->_Rules as $Field => $RulesString)
      {
         $Rules = explode('|', $RulesString);

         if (!in_array('Required', $Rules))
         {
            if (!isset($this->_Array[$Field]))
            {
               continue;
            }
            else if ($this->_Array[$Field]=='')
            {
               continue;
            }
         }
       
         foreach ($Rules As $Rule)                              
         {
            $Param = '';
            if (preg_match("/.*?(\(.*?\)).*/", $Rule, $Match))
            {
               $Param = substr(substr($Match['1'], 1), 0, -1);
               $Rule  = str_replace($Match['1'], '', $Rule);      
            }

            if (!isset($this->_Array[$Field]))
            {
               $Data = '';
            }
            else
            {
               $Data = $this->_Array[$Field];
            }
           
            if (function_exists($Rule))
            {
               $Result = $Rule($Data,$Field,$Param);
            }
            else if (method_exists($this, $Rule))
            {
               $Result = $this->$Rule($Data,$Field,$Param);
            }
            else
            {
               $this->_ErrorList[$Field] = sprintf("Rule %s was not found.", $Rule);
               continue 2;
            }

            if ($Result == FALSE)
            {
               if (isset($this->_ErrorMessages[$Rule]))
               {
                  if (isset($this->_Fields[$Field]))
                  {
                     $FieldName = $this->_Fields[$Field];
                  }
                  else
                  {
                     $FieldName = $Field;
                  }
                  $this->_ErrorList[$Field] = sprintf($this->_ErrorMessages[$Rule], $FieldName, $Param);
               }
               else
               {
                  $this->_ErrorList[$Field] = sprintf("Error message for rule %s was not found.", $Rule);
               }
               continue 2;
            }
         }
      }
      if (count($this->_ErrorList)>=1)
      {        
         return FALSE;
      }
      else
      {
         return TRUE;
      }
   }

   function Required($x, $field)
   {
      return(isset($this->_Array[$field]));
   }


   function NotNull($str)
   {
      return(!empty($str));
   }

   function Matches($str, $afield, $bfield)
   {
      if (!isset($this->_Array[$bfield]))
      {
         return FALSE;
      }
      return ($str !== $this->_Array[$bfield]) ? FALSE : TRUE;
   }

   function MinLength($str, $field, $val)
   {
      if (!is_numeric($val))
      {
         return FALSE;
      }
      return (strlen($str) < $val) ? FALSE : TRUE;
   }

   function MaxLength($str, $field, $val)
   {
      if (!is_numeric($val))
      {
         return FALSE;
      }
      return (strlen($str) > $val) ? FALSE : TRUE;
   }

   function Length($str, $field, $val)
   {
      if (!is_numeric($val))
      {
         return FALSE;
      }
      return (strlen($str) != $val) ? FALSE : TRUE;
   }

   function Email($str)
   {
      return ( ! preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str)) ? FALSE : TRUE;
   }

   function Alpha($str)
   {
      return (!preg_match("/^([-a-z])+$/i", $str)) ? FALSE : TRUE;
   }
   
   function AlphaNumeric($str)
   {
      return (!preg_match("/^([-a-z0-9])+$/i", $str)) ? FALSE : TRUE;
   }

   function Numeric($str)
   {
      return (!is_numeric($str)) ? FALSE : TRUE;
   }
   
   function OnList($Data,$Field,$ListString)
   {
      $List = explode(",",str_replace("'","",$ListString));
      return (array_search($Data, $List)===false) ? FALSE : TRUE;
   }
}
?>
