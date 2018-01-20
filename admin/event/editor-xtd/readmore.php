<?php
/**
 * @package     Arastta eCommerce
 * @copyright   2015-2018 Arastta Association. All rights reserved.
 * @copyright   See CREDITS.txt for credits and other copyright notices.
 * @license     GNU GPL version 3; see LICENSE.txt
 * @link        https://arastta.org
 */

class EventEditorXtdReadmore extends Event
{

    public function preAdminEditorToolbarAdd(&$toolbar)
    {
        if (!$this->check()) {
            return;
        }

        $editor = $this->config->get('config_text_editor');

        if ($this->user->isLogged()) {
            $user = $this->user->getParams();

            if (!empty($user['editor'])) {
                $editor = $user['editor'];
            }
        }

        switch ($editor) {
            case 'summernote':
                $toolbar['readmore'] = array('readmore');
                $this->document->addScript('view/javascript/summernote/plugins/readmore/plugin.js');
                break;
            case 'tinymce':
                $toolbar['readmore'] = array('readmore');
                $this->document->addScript('view/javascript/tinymce/plugins/readmore/plugin.js');
                break;
            #new-editor-add
        }
    }

    public function preAdminEditorMenuAdd(&$menu)
    {
        if (!$this->check()) {
            return;
        }

        $editor = $this->config->get('config_text_editor');

        if ($this->user->isLogged()) {
            $user = $this->user->getParams();

            if (!empty($user['editor'])) {
                $editor = $user['editor'];
            }
        }

        switch ($editor) {
            case 'tinymce':
                $menu['readmore'] = array('readmore');
                break;
            #new-editor-add
        }
    }

    public function check()
    {
        if (isset($this->request->get['route']) && strpos($this->request->get['route'], 'catalog/product') !== false) {
            return true;
        }

        return false;
    }
}
