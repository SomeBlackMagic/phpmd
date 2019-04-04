<?php
/**
 * This file is part of PHP Mess Detector.
 *
 * Copyright (c) Manuel Pichler <mapi@phpmd.org>.
 * All rights reserved.
 *
 * Licensed under BSD License
 * For full copyright and license information, please see the LICENSE file.
 * Redistributions of files must retain the above copyright notice.
 *
 * @author Manuel Pichler <mapi@phpmd.org>
 * @copyright Manuel Pichler. All rights reserved.
 * @license https://opensource.org/licenses/bsd-license.php BSD License
 * @link http://phpmd.org/
 */

namespace PHPMD\Renderer;

use ArrayIterator;
use PHPMD\AbstractTest;
use PHPMD\Stubs\WriterStub;


/**
 * Test case for the ansi renderer implementation.
 *
 * @covers \PHPMD\Renderer\JunitRenderer
 */
class JunitRendererTest extends AbstractTest
{
    /**
     * testRendererOutputsForReportWithContents
     *
     * @return void
     */
    public function testRendererOutputsForReportWithContents()
    {

        $writer = new WriterStub();

        $violations = array(
            $this->getRuleViolationMock('/bar.php', 1),
            $this->getRuleViolationMock('/foo.php', 2),
            $this->getRuleViolationMock('/foo.php', 3),
        );

        $errors = [
            $this->getErrorMock(),
        ];

        $report = $this->getReportMock(0);
        $report->expects($this->once())
            ->method('getRuleViolations')
            ->willReturn(new ArrayIterator($violations));
        $report->expects($this->atLeastOnce())
            ->method('getErrors')
            ->willReturn(new ArrayIterator($errors));

        $renderer = new JunitRenderer();
        $renderer->setWriter($writer);

        $renderer->start();
        $renderer->renderReport($report);
        $renderer->end();
        $result = '<?xml version="1.0" encoding="UTF-8" ?>
<testsuites>
  <testsuite package="PHPMD" name="/bar.php" time="0" tests="1" errors="1">
    <testcase time="0" name="RuleStub"><failure message="Test description"><![CDATA[line 1, Error - Test description (TestRuleSet)]]></failure>
    </testcase>
  </testsuite>
  <testsuite package="PHPMD" name="/foo.php" time="0" tests="2" errors="2">
    <testcase time="0" name="RuleStub"><failure message="Test description"><![CDATA[line 2, Error - Test description (TestRuleSet)]]></failure>
    </testcase>
    <testcase time="0" name="RuleStub"><failure message="Test description"><![CDATA[line 3, Error - Test description (TestRuleSet)]]></failure>
    </testcase>
  </testsuite>
  <testsuite package="PHPMD" name="/foo/baz.php" time="0" tests="1" errors="1">
    <testcase time="0" name="error"><failure message="Error in file &quot;/foo/baz.php&quot;"></failure>
    </testcase>
  </testsuite>
</testsuites>
';
        self::assertEquals($result,  $writer->getData());

    }
}
