<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2017/01/24
 * Time: 12:38 PM
 */

namespace GSDH;

class gsdh_box
{
    var $prefix = 'gsdh_';
    var $textDomain = 'gsdh';
    var $meta_boxes = [];

    function __construct()
    {

        add_filter('rwmb_meta_boxes', [$this, 'register_meta_boxes']);

    }


    function register_meta_boxes($meta_boxes)
    {

        $prefix = $this->prefix;
        $textDomain = $this->textDomain;

        # AWARD FIELDS
        $this->awardFields();
        $this->listingFields();
        $this->slidesFields();
        $this->bookingFields();
        $this->requestFields();

        return $this->meta_boxes;

    }

    function requestFields()
    {

        $prefix = $this->prefix;
        $textDomain = $this->textDomain;

        $prefix .= 'request_';

        $this->meta_boxes[] = ['id' => 'request_data',
            'title' => esc_html__('Request Callback Details', $textDomain),
            'post_types' => ['request'],
            'context' => 'normal',
            'priority' => 'high',
            'autosave' => true,
            'fields' => [
                ['name' => esc_html__('Name', $textDomain),
                    'id' => "{$prefix}name",
                    'type' => 'textfield',
                ],
                ['name' => esc_html__('Email', $textDomain),
                    'id' => "{$prefix}email",
                    'type' => 'textfield',
                ],
                ['name' => esc_html__('Telephone', $textDomain),
                    'id' => "{$prefix}tel",
                    'type' => 'textfield',
                ],
            ]];


        return $this->meta_boxes;

    }

    function bookingFields()
    {

        $prefix = $this->prefix;
        $textDomain = $this->textDomain;

        $prefix .= 'bookings_';

        $this->meta_boxes[] = ['id' => 'bookings_data',
            'title' => esc_html__('Booking Details', $textDomain),
            'post_types' => ['bookings'],
            'context' => 'normal',
            'priority' => 'high',
            'autosave' => true,
            'fields' => [
                ['name' => esc_html__('Name', $textDomain),
                    'id' => "{$prefix}name",
                    'type' => 'textfield',
                ],
                ['name' => esc_html__('Email', $textDomain),
                    'id' => "{$prefix}email",
                    'type' => 'textfield',
                ],
                ['name' => esc_html__('Telephone', $textDomain),
                    'id' => "{$prefix}tel",
                    'type' => 'textfield',
                ],
                ['name' => esc_html__('Message', $textDomain),
                    'id' => "{$prefix}message",
                    'type' => 'textfield',
                ],
                ['name' => esc_html__('Date', $textDomain),
                    'id' => "{$prefix}date",
                    'type' => 'textfield',
                ],
            ]];


        return $this->meta_boxes;

    }

    function slidesFields()
    {

        $prefix = $this->prefix;
        $textDomain = $this->textDomain;

        $prefix .= 'slides_';

        $this->meta_boxes[] = ['id' => 'slides_data',
            'title' => esc_html__('Slide content', $textDomain),
            'post_types' => ['slides'],
            'context' => 'normal',
            'priority' => 'high',
            'autosave' => true,
            'fields' => [
                ['name' => esc_html__('Slide Image', $textDomain),
                    'id' => "{$prefix}image",
                    'type' => 'image_advanced',
                    'max_file_uploads' => 1,
                ],
                ['name' => esc_html__('Slide Background Color', $textDomain),
                    'id' => "{$prefix}bg",
                    'type' => 'color',
                ],
            ]];


        return $this->meta_boxes;

    }

    function awardFields()
    {

        $prefix = $this->prefix;
        $textDomain = $this->textDomain;

        $prefix .= 'awards_';

        $this->meta_boxes[] = ['id' => 'awards_data',
            'title' => esc_html__('Award content', $textDomain),
            'post_types' => ['awards'],
            'context' => 'normal',
            'priority' => 'high',
            'autosave' => true,
            'fields' => [
                ['name' => esc_html__('Award Image', $textDomain),
                    'id' => "{$prefix}image",
                    'type' => 'image_advanced',
                    'max_file_uploads' => 1,
                ],
                ['name' => esc_html__('URL', $textDomain),
                    'id' => "{$prefix}url",
                    'type' => 'textfield',
                ],
            ]];


        return $this->meta_boxes;

    }

    function listingFields()
    {

        $prefix = $this->prefix;
        $textDomain = $this->textDomain;

        $prefix .= 'listings_';

        $this->meta_boxes[] = ['id' => 'listing_data',
            'title' => esc_html__('Listing content', $textDomain),
            'post_types' => ['listings'],
            'context' => 'normal',
            'priority' => 'high',
            'autosave' => true,
            'fields' => [
                ['name' => esc_html__('Title', $textDomain),
                    'id' => "{$prefix}title",
                    'type' => 'textfield',
                ],
                ['name' => esc_html__('Award Image', $textDomain),
                    'id' => "{$prefix}image",
                    'type' => 'image_advanced',
                    'max_file_uploads' => 1,
                ],
            ]];


        return $this->meta_boxes;

    }

}
