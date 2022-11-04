<?php

namespace App\Services; // on met App au lieu de scr

use Symfony\Component\Form\Form;


class ImageManager
{

    const UPLOAD_DIR = 'photos';
    /**
     * Undocumented function
     *
     * @param Form $form
     * @param [type] $fields
     * @param [type] $object
     * @param [type] $default
     * @return void
     */
    public function loadImage(Form $form, $fields, $object, $default = null)
    {
        // je récupère le fichier passé dans le formulaire :
            $image = $form->get($fields)->getData();

            // je fabrique ma méthode en fonction du nom du fields :
            $methode = 'set' . ucfirst($fields);

            // on va donner un nouveau nom à l'image : le serveur distant va écraser le fichier s'il existe : donc on lui trouve un nom unique pour éviter cela :
            if ($image){
                $new_name_image = uniqid() . '.' . $image->guessExtension();
                $image->move(
                    self::UPLOAD_DIR,//destination
                    $new_name_image,// nom de l'image
                );
                $object->$methode($new_name_image); // l'objet à setter
            }else{
                $object->$methode($default);


    }
}

}
