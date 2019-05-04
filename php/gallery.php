<?
/*
echo "<pre>";
print_r($_POST);
echo "</pre>";
*/

require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';

if (CModule::IncludeModule('iblock')) { 
    echo "<script>console.log('modul iblock');</script>"; 
    $arFilter = Array("IBLOCK_ID"=>10, "ACTIVE"=>"Y", "PROPERTY_komplex"=>$_POST["num_komplex"], "PROPERTY_block"=>$_POST["id_block"], "PROPERTY_levelnumber"=>$_POST["num_et"]);
    $resList = CIBlockElement::GetList(array(), $arFilter);
    
    if($resList){
        echo "<script>console.log('определен список');</script>";  
            if($obList = $resList->GetNextElement()){
                $arListFields = $obList->GetFields();
                $arListProperties = $obList->GetProperties();
                $block_slide_url = CFile::GetPath($arListFields["DETAIL_PICTURE"]);  
                echo '<div class="block-select-block-level" data-id-block-level="'.$arListFields["ID"].'"> <img  src="'.$block_slide_url.'" ></div> ';                               
            }
                   
    }

    else{
        echo "<script>console.log('не определен список');</script>";
    } 
    
    
}
else{
    echo "<script>console.log('no modul iblock');</script>";    
}
?>