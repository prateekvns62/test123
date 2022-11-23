<?php
namespace Amasty\PageSpeedOptimizer\Api\QueueRepositoryInterface;

/**
 * Proxy class for @see \Amasty\PageSpeedOptimizer\Api\QueueRepositoryInterface
 */
class Proxy implements \Amasty\PageSpeedOptimizer\Api\QueueRepositoryInterface, \Magento\Framework\ObjectManager\NoninterceptableInterface
{
    /**
     * Object Manager instance
     *
     * @var \Magento\Framework\ObjectManagerInterface
     */
    protected $_objectManager = null;

    /**
     * Proxied instance name
     *
     * @var string
     */
    protected $_instanceName = null;

    /**
     * Proxied instance
     *
     * @var \Amasty\PageSpeedOptimizer\Api\QueueRepositoryInterface
     */
    protected $_subject = null;

    /**
     * Instance shareability flag
     *
     * @var bool
     */
    protected $_isShared = null;

    /**
     * Proxy constructor
     *
     * @param \Magento\Framework\ObjectManagerInterface $objectManager
     * @param string $instanceName
     * @param bool $shared
     */
    public function __construct(\Magento\Framework\ObjectManagerInterface $objectManager, $instanceName = '\\Amasty\\PageSpeedOptimizer\\Api\\QueueRepositoryInterface', $shared = true)
    {
        $this->_objectManager = $objectManager;
        $this->_instanceName = $instanceName;
        $this->_isShared = $shared;
    }

    /**
     * @return array
     */
    public function __sleep()
    {
        return ['_subject', '_isShared', '_instanceName'];
    }

    /**
     * Retrieve ObjectManager from global scope
     */
    public function __wakeup()
    {
        $this->_objectManager = \Magento\Framework\App\ObjectManager::getInstance();
    }

    /**
     * Clone proxied instance
     */
    public function __clone()
    {
        $this->_subject = clone $this->_getSubject();
    }

    /**
     * Get proxied instance
     *
     * @return \Amasty\PageSpeedOptimizer\Api\QueueRepositoryInterface
     */
    protected function _getSubject()
    {
        if (!$this->_subject) {
            $this->_subject = true === $this->_isShared
                ? $this->_objectManager->get($this->_instanceName)
                : $this->_objectManager->create($this->_instanceName);
        }
        return $this->_subject;
    }

    /**
     * {@inheritdoc}
     */
    public function addToQueue(\Amasty\PageSpeedOptimizer\Api\Data\QueueInterface $queue)
    {
        return $this->_getSubject()->addToQueue($queue);
    }

    /**
     * {@inheritdoc}
     */
    public function removeFromQueue(\Amasty\PageSpeedOptimizer\Api\Data\QueueInterface $queue)
    {
        return $this->_getSubject()->removeFromQueue($queue);
    }

    /**
     * {@inheritdoc}
     */
    public function shuffleQueues($limit = 10)
    {
        return $this->_getSubject()->shuffleQueues($limit);
    }

    /**
     * {@inheritdoc}
     */
    public function clearQueue()
    {
        return $this->_getSubject()->clearQueue();
    }

    /**
     * {@inheritdoc}
     */
    public function isQueueEmpty()
    {
        return $this->_getSubject()->isQueueEmpty();
    }

    /**
     * {@inheritdoc}
     */
    public function getQueueSize()
    {
        return $this->_getSubject()->getQueueSize();
    }
}
