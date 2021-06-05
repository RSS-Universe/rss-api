<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     3.0.0
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */

namespace App\View;

use App\View\Helper;
use BootstrapUI\View\Helper as BootstrapUIHelper;
use BootstrapUI\View\UIViewTrait;
use Cake\View\View;
use Commentable\View\Helper\CommentHelper;

/**
 * Application View
 *
 * Your application's default view class
 *
 * @link https://book.cakephp.org/3/en/views.html#the-app-view
 *
 * @property Helper\AuthHelper $Auth
 * @property Helper\NavLinksHelper $NavLinks
 * @property Helper\ActiveIndicatorHelper $ActiveIndicator
 * @property Helper\GravatarHelper $Gravatar
 * @property Helper\ModalHelper $Modal
 *
 * @property BootstrapUIHelper\HtmlHelper $Html
 * @property BootstrapUIHelper\FormHelper $Form
 * @property BootstrapUIHelper\FlashHelper $Flash
 * @property BootstrapUIHelper\PaginatorHelper $Paginator
 * @property BootstrapUIHelper\BreadcrumbsHelper $Breadcrumbs
 *
 * @property CommentHelper $Comment
 */
class AppView extends View
{
    use UIViewTrait;

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading helpers.
     *
     * e.g. `$this->loadHelper('Html');`
     *
     * @return void
     */
    public function initialize()
    {
        $this->initializeUI([
            'layout' => 'bootstrap'
        ]);
        $this->loadHelper('Auth');
        $this->loadHelper('NavLinks');
        $this->loadHelper('ActiveIndicator');
        $this->loadHelper('Gravatar');
        $this->loadHelper('Commentable.Comment');
        $this->loadHelper('Modal');
    }
}
