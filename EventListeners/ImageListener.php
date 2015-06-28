<?php
/**
 * @author Franck Allimant <franck@cqfdev.fr>
 *
 * Creation date: 27/02/2015 01:09
 */

namespace Filigrane\EventListeners;

use Imagine\Image\Box;
use Imagine\Image\Color;
use Imagine\Image\ImagineInterface;
use Imagine\Image\Point;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Thelia\Core\Event\Image\ImageEvent;
use Thelia\Core\Event\TheliaEvents;
use Imagine\Gd\Font;
use Thelia\Log\Tlog;
use Thelia\Model\ConfigQuery;

class ImageListener implements EventSubscriberInterface
{
    public function addWatermark(ImageEvent $event)
    {
        $image = $event->getImageObject();

        $size = $image->getSize();

        Tlog::getInstance()->debug("Category: ".$event->getCacheSubdirectory());

        if ($event->getCacheSubdirectory() == 'product' && $size->getHeight() > 200) {
            $imagine = $this->createImagineInstance();

            $watermark = $imagine->open(__DIR__ . DS . '..' . DS . '/Config/watermark.png');

            $watermark->resize(
                $watermark->getSize()->heighten(round(.1 * $size->getHeight()))
            );

            $wSize = $watermark->getSize();

            $delta = round(.02 * $size->getHeight());

            $bottomRight = new Point(
                $size->getWidth() - $wSize->getWidth() - $delta,
                $size->getHeight() - $wSize->getHeight() - $delta
            );

            $image->paste($watermark, $bottomRight);
        }
    }

    /**
     * Create a new Imagine object using current driver configuration
     *
     * @return ImagineInterface
     */
    protected function createImagineInstance()
    {
        $driver = ConfigQuery::read("imagine_graphic_driver", "gd");

        switch ($driver) {
            case 'imagick':
                $image = new \Imagine\Imagick\Imagine();
                break;

            case 'gmagick':
                $image = new \Imagine\Gmagick\Imagine();
                break;

            case 'gd':
            default:
                $image = new \Imagine\Gd\Imagine();
        }

        return $image;
    }

    public static function getSubscribedEvents()
    {
        return array(
            TheliaEvents::IMAGE_POSTPROCESSING => array("addWatermark", 130)
        );
    }
}