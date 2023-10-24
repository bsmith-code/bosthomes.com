<?php

use Carbon_Fields\Container\Container;
use Carbon_Fields\Field\Field;

Container::make('nav_menu', 'Menu Settings')
    ->add_fields(array(
        Field::make('image', 'crb_image'),
    ));