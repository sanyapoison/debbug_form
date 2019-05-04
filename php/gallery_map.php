<?
if(!(strlen($_POST["id_et"])))
    $_POST["id_et"] = 0;

if(!(strlen($_POST["id_block"])))
    $_POST["id_block"] = 0;

/*
echo "<pre>";
print_r($_POST);
echo "</pre>";
*/

require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';

if (CModule::IncludeModule('iblock')) { 
    echo "<script>console.log('modul iblock_map');</script>"; 
    $arFilter = Array("IBLOCK_ID"=>11, "ACTIVE"=>"Y", "PROPERTY_komplex"=>$_POST["num_komplex"], "PROPERTY_block"=>$_POST["id_block"], "PROPERTY_level"=>$_POST["id_et"]);
    $resList = CIBlockElement::GetList(array(), $arFilter);
    
    if($resList){
        echo "<script>console.log('определен список комнат');</script>";  
            while($obList = $resList->GetNextElement()){
                $arListFields = $obList->GetFields();
                $arListProperties = $obList->GetProperties();
                $block_slide_url = CFile::GetPath($arListFields["PREVIEW_PICTURE"]);  
                $block_slide_url_detail = CFile::GetPath($arListFields["DETAIL_PICTURE"]);  
                $arListProperties_th_kwar_pdf_VALUE = CFile::GetPath($arListProperties["th_kwar_pdf"]["VALUE"]);                     
                ?>
                <div class="block-select-block-level-map" data-kwart-id="<?=$arListFields["ID"]?>" data-kwart-detail_photo="<?=$block_slide_url_detail?>" data-komplex-id="<?=$arListProperties["komplex"]["VALUE"];?>" data-block-id="<?=$arListProperties["block"]["VALUE"];?>" data-level="<?=$arListProperties["level"]["VALUE"];?>" data-komplex-id="<?=$arListProperties["komplex"]["VALUE"];?>"  data-kwart_number="<?=$arListProperties["kwart_number"]["VALUE"];?>" data-price="<?=$arListProperties["price"]["VALUE"];?>" data-old_price="<?=$arListProperties["old_price"]["VALUE"];?>" data-count_map="<?=$arListProperties["count_map"]["VALUE"];?>" data-size="<?=$arListProperties["size"]["VALUE"];?>" data-kadastr="<?=$arListProperties["kadastr"]["VALUE"];?>" data-th_kwar_pdf="<?=$arListProperties_th_kwar_pdf_VALUE;?>"> <img  src="<?=$block_slide_url?>" ></div>
                 
                <?  
                /*  
                echo "<pre>";
                print_r($arListProperties);
                echo "</pre>"; 
                */               
            }
                   
    }

    else{
        echo "<script>console.log('не определен список комнат');</script>";
    } 
    
    
}
else{
    echo "<script>console.log('no modul iblock_map');</script>";    
}
?>