<?php
namespace Magento\Cms\Model\Wysiwyg\Images\Storage;

/**
 * Interceptor class for @see \Magento\Cms\Model\Wysiwyg\Images\Storage
 */
class Interceptor extends \Magento\Cms\Model\Wysiwyg\Images\Storage implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\Model\Session $session, \Magento\Backend\Model\UrlInterface $backendUrl, \Magento\Cms\Helper\Wysiwyg\Images $cmsWysiwygImages, \Magento\MediaStorage\Helper\File\Storage\Database $coreFileStorageDb, \Magento\Framework\Filesystem $filesystem, \Magento\Framework\Image\AdapterFactory $imageFactory, \Magento\Framework\View\Asset\Repository $assetRepo, \Magento\Cms\Model\Wysiwyg\Images\Storage\CollectionFactory $storageCollectionFactory, \Magento\MediaStorage\Model\File\Storage\FileFactory $storageFileFactory, \Magento\MediaStorage\Model\File\Storage\DatabaseFactory $storageDatabaseFactory, \Magento\MediaStorage\Model\File\Storage\Directory\DatabaseFactory $directoryDatabaseFactory, \Magento\MediaStorage\Model\File\UploaderFactory $uploaderFactory, array $resizeParameters = array(), array $extensions = array(), array $dirs = array(), array $data = array())
    {
        $this->___init();
        parent::__construct($session, $backendUrl, $cmsWysiwygImages, $coreFileStorageDb, $filesystem, $imageFactory, $assetRepo, $storageCollectionFactory, $storageFileFactory, $storageDatabaseFactory, $directoryDatabaseFactory, $uploaderFactory, $resizeParameters, $extensions, $dirs, $data);
    }

    /**
     * {@inheritdoc}
     */
    public function deleteFile($target)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'deleteFile');
        if (!$pluginInfo) {
            return parent::deleteFile($target);
        } else {
            return $this->___callPlugins('deleteFile', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function uploadFile($targetPath, $type = null)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'uploadFile');
        if (!$pluginInfo) {
            return parent::uploadFile($targetPath, $type);
        } else {
            return $this->___callPlugins('uploadFile', func_get_args(), $pluginInfo);
        }
    }
}
