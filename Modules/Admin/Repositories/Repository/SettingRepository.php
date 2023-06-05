<?php

namespace Modules\Admin\Repositories\Repository;

use Illuminate\Support\Facades\Cache;
use Modules\Admin\Repositories\Interfaces\SettingInterface;
use Modules\User\Entities\Message;

class SettingRepository implements SettingInterface{

     protected $path="images/setting/";

     public function updateHomePage($request){
         $this->path.="/home";
          $settings=Cache::get('settings');
        //   dd( $settings['home']);
    if( isset($request->first_section["poster"]) &&  $request->file($request->first_section["poster"])){
            $first_section_image="storage/".$this->path."/".storeImage($this->path,$request->first_section["poster"]);
          }
          else
          {
            $first_section_image=$settings['home']["first_section"]["poster"];}
        //   dd($first_section_image);
        
         $settings['home']["first_section"]["ar"]=[
            "sliders"=>$request->first_section["ar"]["sliders"],


         ];

         $settings['home']["first_section"]["en"]=[
            "sliders"=>$request->first_section["en"]["sliders"],

         ];
         $settings['home']["first_section"]["video"]=$request->first_section["video"];
         $settings['home']["first_section"]["poster"]=$first_section_image;


         $settings['home']["seconed_section"]["ar"]=[
            "title"=>$request->seconed_section["ar"]["title"],
            "description"=>$request->seconed_section["ar"]["description"],
            "urls"=>$request->seconed_section["ar"]["urls"],

         ];
         $settings['home']["seconed_section"]["en"]=[
            "title"=>$request->seconed_section["en"]["title"],
            "description"=>$request->seconed_section["en"]["description"],
            "urls"=>$request->seconed_section["en"]["urls"],
         ];
        //  foreach($request->third_section["ar"]["sliders"] as $loop=>$slider){
        //         foreach($slider as $key=>$item)
        //         if($key=='video' || $key=='poster'){
        //         $request->third_section["en"]["sliders"][$loop][$key]=$slider[$key];
        //       }
        //  }
        $thirdSection = $request->third_section;
$enSliders = [];
foreach($request->third_section["ar"]["sliders"] as $loop => $slider){
    $newSlider = [];
    foreach($slider as $key => $item) {
        if($key=='video' || $key=='poster'){
            
            if($key=='poster'){
                if($slider[$key] instanceof \Illuminate\Http\UploadedFile){
                    $slider[$key]="storage/".$this->path."/".storeImage($this->path,$slider[$key]);
                    $thirdSection["ar"]["sliders"][$loop][$key]=$slider[$key];
                }
                else{
                    $slider[$key]=$settings['home']['third_section']['ar']["sliders"][$loop][$key];
              }
}
            $newSlider[$key] = $slider[$key];
        }
        else{
            $newSlider[$key] =$thirdSection["en"]["sliders"][$loop][$key];

        }
    }
    
 
 
 
 
    if(!array_search('poster',array_keys($slider))){
       $newSlider['poster']=$settings['home']['third_section']['ar']["sliders"][$loop]['poster'];
       $thirdSection['ar']['sliders'][$loop]['poster']=$settings['home']['third_section']['ar']["sliders"][$loop]['poster'];
}
    $enSliders[$loop] = $newSlider;
}
$thirdSection["en"]["sliders"] = $enSliders;


$request->third_section = $thirdSection;

         $settings['home']["third_section"]["ar"]=[
            "sliders"=>$request->third_section["ar"]["sliders"],
         ];
         $settings['home']["third_section"]["en"]=[
            "sliders"=>$request->third_section["en"]["sliders"],
         ];

         $thirdSection = $request->fourth_section;
         $enSliders = [];
         foreach($request->fourth_section["ar"]["sliders"] as $loop => $slider){
             $newSlider = [];
             foreach($slider as $key => $item) {
                 if($key=='video' || $key=='poster'){
                     
                     if($key=='poster'){
                        if($slider[$key] instanceof \Illuminate\Http\UploadedFile){
                            $slider[$key]="storage/".$this->path."/".storeImage($this->path,$slider[$key]);
                            $thirdSection["ar"]["sliders"][$loop][$key]=$slider[$key];
                        }
                        else{
                            $slider[$key]=$settings['home']['fourth_section']['ar']["sliders"][$loop][$key];
                        }
    }
    
    
    
                     $newSlider[$key] = $slider[$key];
                 }
                 else{
                     $newSlider[$key] =$thirdSection["en"]["sliders"][$loop][$key];

                 }
             }
             
         

             if(!array_search('poster',array_keys($slider))){
                $newSlider['poster']=$settings['home']['fourth_section']['ar']["sliders"][$loop]['poster'];
                $thirdSection['ar']['sliders'][$loop]['poster']=$settings['home']['fourth_section']['ar']["sliders"][$loop]['poster'];
}
             
             
             $enSliders[$loop] = $newSlider;
         }

         $thirdSection["en"]["sliders"] = $enSliders;
         
  
         $request->fourth_section = $thirdSection;

         $settings["home"]["fourth_section"]["en"]=[
            "sliders"=>$request->fourth_section["en"]["sliders"],
         ];
         $settings["home"]["fourth_section"]["ar"]=[
            "sliders"=>$request->fourth_section["ar"]["sliders"],
         ];
       $images=$settings["home"]["fifth_section"]["ar"]["images"];
         if( isset($request->fifth_section['images']) &&  $request->fifth_section['images'])
         {
            foreach($request->fifth_section["images"] as $image){
                $path="storage/".$this->path."/".storeImage($this->path,$image);
                array_push($images,$path);

         }
}
         $settings["home"]["fifth_section"]["ar"]=[
           "title"=>$request->fifth_section["ar"]["title"],
           "description"=>$request->fifth_section["ar"]["description"],
           "feachers"=>$request->fifth_section["ar"]["feachers"],
           "images"=>$images,
           "text_photos"=>$request->fifth_section["ar"]["text_photos"]
         ];
         $settings["home"]["fifth_section"]["en"]=[
           "title"=>$request->fifth_section["en"]["title"],
           "description"=>$request->fifth_section["en"]["description"],
           "feachers"=>$request->fifth_section["en"]["feachers"],
           "images"=>$images,
           "text_photos"=>$request->fifth_section["en"]["text_photos"]
         ];

          Cache::put("settings",$settings);
          return true;
     }
     public function updateuAboutUsPage($request){
         $this->path.="/aboutus/aboutus";
        $settings=Cache::get('settings');
        $first_section_image='';
        if(!empty($request->first_section["photo"])){
            $first_section_image="storage/".$this->path."/".storeImage($this->path,$request->first_section["photo"]);

        }

        $settings["aboutus"]["first_section"]["ar"]=[
            "title"=>$request->first_section["ar"]["title"],
            "description"=>$request->first_section["ar"]["description"],
            "feachers"=>$request->first_section["ar"]["feachers"],
            "photo"=>$first_section_image,
          ];
        $settings["aboutus"]["first_section"]["en"]=[
            "title"=>$request->first_section["en"]["title"],
            "description"=>$request->first_section["en"]["description"],
            "feachers"=>$request->first_section["en"]["feachers"],
            "photo"=>$first_section_image,
          ];

        //   $images=[];
        //   foreach($request->seconed_secetion["images"] as $image){
        //      $path="storage\\".$this->path."\aboutus\\".storeImage($this->path,$image);
        //      array_push($images,$path);

        //   }
        // $settings["aboutus"]["seconed_secetion"]["ar"]=[
        //    "first"=>[
        //     "title"=>$request->seconed_secetion["ar"]["titles"][0],
        //     "description"=>$request->seconed_secetion["ar"]["descriptions"][0],
        //     "photo"=>array_count_values($images)>0?$images[0]:'',
        //    ],
        //    "seconed"=>[
        //     "title"=>$request->seconed_secetion["ar"]["titles"][1],
        //     "description"=>$request->seconed_secetion["ar"]["descriptions"][1],
        //     "photo"=>array_count_values($images)>0?$images[1]:'',
        //    ],
        //    "third"=>[
        //     "title"=>$request->seconed_secetion["ar"]["titles"][2],
        //     "description"=>$request->seconed_secetion["ar"]["descriptions"][2],
        //     "photo"=>array_count_values($images)>0?$images[1]:'',
        //    ],
        //   ];
        // $settings["aboutus"]["seconed_secetion"]["en"]=[
        //    "first"=>[
        //     "title"=>$request->seconed_secetion["en"]["titles"][0],
        //     "description"=>$request->seconed_secetion["en"]["descriptions"][0],
        //     "photo"=>array_count_values($images)>0?$images[0]:'',
        //    ],
        //    "seconed"=>[
        //     "title"=>$request->seconed_secetion["en"]["titles"][1],
        //     "description"=>$request->seconed_secetion["en"]["descriptions"][1],
        //     "photo"=>array_count_values($images)>0?$images[1]:'',
        //    ],
        //    "third"=>[
        //     "title"=>$request->seconed_secetion["en"]["titles"][2],
        //     "description"=>$request->seconed_secetion["en"]["descriptions"][2],
        //     "photo"=>array_count_values($images)>0?$images[1]:'',
        //    ],
        //   ];

          $settings["aboutus"]["seconed_section"]["en"]=[
             "title"=>$request->seconed_section["en"]["title"],
             "description"=>$request->seconed_section["en"]["description"],
           ];
          $settings["aboutus"]["seconed_section"]["ar"]=[
             "title"=>$request->seconed_section["ar"]["title"],
             "description"=>$request->seconed_section["ar"]["description"],
           ];


          Cache::put('settings',$settings);

          return true;

     }
     public function updateMonthlySubscribesPage($request){
         $this->path.="/aboutus";
        $settings=Cache::get('settings');
        $first_section_image='';
        if(!empty($request->subscribes_page["poster"])){
            $first_section_image="storage/".$this->path."/".storeImage($this->path."/subscribe",$request->subscribes_page["poster"]);
        }

        $settings["subscribes_page"]=[
            "ar"=>[
                "title"=>$request["subscribes_page"]["ar"]["title"],
                "card_title"=>$request["subscribes_page"]["ar"]["card_title"],
            ],
            "en"=>[
                "title"=>$request["subscribes_page"]["en"]["title"],
                "card_title"=>$request["subscribes_page"]["en"]["card_title"],
            ],
            "price"=>$request["subscribes_page"]["price"],
            "video"=>$request["subscribes_page"]["video"],
            "poster"=>$first_section_image,
        ];

        Cache::put('settings',$settings);
          return true;

     }

     public function getSettingBykey($key){
        if(Cache::has($key)){
            return Cache::get($key);
        }
        return null;
     }

     public function updateGeneralInfo($request){
         $this->path.="/aboutus/generalInfo";
        $settings=Cache::get('settings');

 $affiliate_sliders=$settings["general_info"]["affilate"]["sliders"];
        $settings["general_info"]=[
            "support_phone"=>$request->support_phone,
            'support_email'=>$request->support_email,
            'whatsapp_phone'=>$request->whatsapp_phone,
            "location"=>$request->location,
            'affilate'=>$request->affilate
        ];
        $settings["general_info"]["affilate"]["sliders"]=$affiliate_sliders;
$first_section_image='';
        $settings["general_info"]["private_payment"]=[
            "photo"=>$first_section_image
];
        if($request->photo){
            $first_section_image="storage/".$this->path."/".storeImage($this->path,$request->photo);

            $settings["general_info"]["private_payment"]=[
                "photo"=>$first_section_image
            ];
        }
        

 

      foreach($request->affilate_sliders["sliders"] as $loop=>$slider){


            $affilate=[];
            foreach($slider as $key=>$value){
              
              if($key=="poster"){
                
                if($value instanceof \Illuminate\Http\UploadedFile)
                  $affilate["poster"]="storage/".$this->path."/".storeImage($this->path, $value );
                   else
                  $affilate["poster"]=$settings["general_info"]["affilate"]["sliders"][$loop]["poster"];
              

              }
              if(! array_key_exists("poster" , $slider )){
    $affilate["poster"]=$settings["general_info"]["affilate"]["sliders"][$loop]["poster"];
              }
            

                  $affilate["video"]=$slider["video"];



             
}
 $settings["general_info"]["affilate"]["sliders"][$loop]=$affilate;

              $affilate=[];

}


        Cache::put('settings',$settings);

        return true;
     }














}
