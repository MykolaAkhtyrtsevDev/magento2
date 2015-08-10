<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magento\Widget\Test\TestCase;

use Magento\Widget\Test\Fixture\Widget;
use Magento\Widget\Test\Page\Adminhtml\WidgetInstanceEdit;
use Magento\Widget\Test\Page\Adminhtml\WidgetInstanceIndex;
use Magento\Mtf\TestCase\Injectable;

/**
 * Test Creation for Delete Widget Entity
 *
 * Test Flow:
 *
 * Preconditions:
 * 1. Create Widget
 *
 * Steps:
 * 1. Login to backend
 * 2. Open Content > Frontend Apps
 * 3. Open Widget from preconditions
 * 4. Delete
 * 5. Perform all asserts
 *
 * @group Widget_(PS)
 * @ZephyrId MAGETWO-28459
 */
class DeleteWidgetEntityTest extends Injectable
{
    /* tags */
    const MVP = 'yes';
    const DOMAIN = 'PS';
    /* end tags */

    /**
     * WidgetInstanceIndex page
     *
     * @var WidgetInstanceIndex
     */
    protected $widgetInstanceIndex;

    /**
     * WidgetInstanceEdit page
     *
     * @var WidgetInstanceEdit
     */
    protected $widgetInstanceEdit;

    /**
     * Injection data
     *
     * @param WidgetInstanceIndex $widgetInstanceIndex
     * @param WidgetInstanceEdit $widgetInstanceEdit
     * @return array
     */
    public function __inject(
        WidgetInstanceIndex $widgetInstanceIndex,
        WidgetInstanceEdit $widgetInstanceEdit
    ) {
        $this->widgetInstanceIndex = $widgetInstanceIndex;
        $this->widgetInstanceEdit = $widgetInstanceEdit;
    }

    /**
     * Delete Widget Entity test
     *
     * @param Widget $widget
     * @return void
     */
    public function test(Widget $widget)
    {
        // Precondition
        $widget->persist();

        // Steps
        $filter = ['title' => $widget->getTitle()];
        $this->widgetInstanceIndex->open();
        $this->widgetInstanceIndex->getWidgetGrid()->searchAndOpen($filter);
        $this->widgetInstanceEdit->getPageActionsBlock()->delete();
    }
}