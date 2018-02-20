<?php
/**
 * Created by PhpStorm.
 * User: infelicitas
 * Date: 10/24/2016
 * Time: 3:45 AM
 */

namespace App\CustomPagination;

use Illuminate\Pagination\BootstrapThreePresenter;


class CustomPagination extends BootstrapThreePresenter {


    public function render()

    {

        if ($this->hasPages()) {

            return sprintf(

                '<ul class="list-inline list-unstyled"><li class="prev">%s </li> <li class="prev">%s </li> %s <li class="next">%s</li> <li class="next">%s</li></ul>',

                $this->getFirst(),

                $this->getButtonPre(),

                $this->getLinks(),

                $this->getButtonNext(),

                $this->getLast()

            );

        }

        return "";

    }


    public function getLast()

    {

        $url = $this->paginator->url($this->paginator->lastPage());

        $btnStatus = '';


        if($this->paginator->lastPage() == $this->paginator->currentPage()){

            $btnStatus = 'disabled';

        }

        return $btn = "<a href='".$url."'>Last <i class='glyphicon glyphicon-chevron-right'></i></a>";

    }


    public function getFirst()

    {

        $url = $this->paginator->url(1);

        $btnStatus = '';


        if(1 == $this->paginator->currentPage()){

            $btnStatus = 'disabled';

        }

        return $btn = "<a href='".$url."'><i class='glyphicon glyphicon-chevron-left'></i> First</a>";

    }


    public function getButtonPre()

    {

        $url = $this->paginator->previousPageUrl();

        $btnStatus = '';


        if(empty($url)){

            $btnStatus = 'disabled';

        }

        return $btn = "<a href='".$url."'><i class='glyphicon glyphicon-chevron-left pagi-margin'></i><i class='glyphicon glyphicon-chevron-left'></i> Previous </a>";

    }


    public function getButtonNext()

    {

        $url = $this->paginator->nextPageUrl();

        $btnStatus = '';


        if(empty($url)){

            $btnStatus = 'disabled';

        }

        return $btn = "<a href='".$url."'>Next <i class='glyphicon glyphicon-chevron-right pagi-margin'></i><i class='glyphicon glyphicon-chevron-right'></i></button></a>";

    }


}