<?php
require_once 'class.file.php';

/**
 * Description of class
 *
 * @author Srdjan
 *
 * $HeadURL: https://www.onthegosystems.com/misc_svn/common/tags/1.4/toolset-forms/classes/class.video.php $
 * $LastChangedDate: 2014-09-29 16:01:46 +0000 (Mon, 29 Sep 2014) $
 * $LastChangedRevision: 27533 $
 * $LastChangedBy: marcin $
 *
 */
class WPToolset_Field_Video extends WPToolset_Field_File
{
    protected $_settings = array('min_wp_version' => '3.6');

    public function metaform()
    {
        $validation = $this->getValidationData();
        $validation = self::addTypeValidation($validation);
        $this->setValidationData($validation);
        return parent::metaform();
    }

    public static function addTypeValidation($validation)
    {
        $valid_extensions = array(
            '3gp',
            'aaf',
            'asf',
            'avchd',
            'avi',
            'cam',
            'dat',
            'dsh',
            'fla',
            'flr',
            'flv',
            'm1v',
            'm2v',
            'm4v',
            'mng',
            'mp4',
            'mxf',
            'nsv',
            'ogg',
            'rm',
            'roq',
            'smi',
            'sol',
            'svi',
            'swf',
            'wmv',
            'wrap',
            'mkv',
            'mov',
            'mpe',
            'mpeg',
            'mpg',
        );
        $valid_extensions = apply_filters( 'toolset_valid_video_extentions', $valid_extensions);
        $validation['extension'] = array(
            'args' => array(
                'extension',
                implode('|', $valid_extensions),
            ),
            'message' => __( 'You can add only video.', 'wpv-views' ),
        );
        return $validation;
    }
}
