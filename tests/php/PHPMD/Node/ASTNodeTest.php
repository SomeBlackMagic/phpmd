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

namespace PHPMD\Node;

use PHPMD\AbstractTest;
use PDepend\Source\AST\ASTNode;
use PHPMD\AbstractRule;

/**
 * Test case for the {@link \PHPMD\Node\ASTNode} class.
 *
 * @covers \PHPMD\Node\ASTNode
 */
class ASTNodeTest extends AbstractTest
{
    /**
     * testGetImageDelegatesToGetImageMethodOfWrappedNode
     *
     * @return void
     */
    public function testGetImageDelegatesToGetImageMethodOfWrappedNode()
    {
        $mock = $this->getMock(ASTNode::class);
        $mock->expects($this->once())
            ->method('getImage');

        $node = new ASTNode($mock, __FILE__);
        $node->getImage();
    }

    /**
     * testGetNameDelegatesToGetImageMethodOfWrappedNode
     *
     * @return void
     */
    public function testGetNameDelegatesToGetImageMethodOfWrappedNode()
    {
        $mock = $this->getMock(ASTNode::class);
        $mock->expects($this->once())
            ->method('getImage');

        $node = new ASTNode($mock, __FILE__);
        $node->getName();
    }

    /**
     * testHasSuppressWarningsAnnotationForAlwaysReturnsFalse
     *
     * @return void
     */
    public function testHasSuppressWarningsAnnotationForAlwaysReturnsFalse()
    {
        $mock = $this->getMock(ASTNode::class);

        $node = new ASTNode($mock, __FILE__);
        $rule = $this->getMockForAbstractClass(AbstractRule::class);

        $this->assertFalse($node->hasSuppressWarningsAnnotationFor($rule));
    }

    /**
     * testGetParentNameReturnsNull
     *
     * @return void
     */
    public function testGetParentNameReturnsNull()
    {
        $mock = $this->getMock(ASTNode::class);
        $node = new ASTNode($mock, __FILE__);

        $this->assertNull($node->getParentName());
    }

    /**
     * testGetNamespaceNameReturnsNull
     *
     * @return void
     */
    public function testGetNamespaceNameReturnsNull()
    {
        $mock = $this->getMock(ASTNode::class);
        $node = new ASTNode($mock, __FILE__);

        $this->assertNull($node->getNamespaceName());
    }

    /**
     * testGetFullQualifiedNameReturnsNull
     *
     * @return void
     */
    public function testGetFullQualifiedNameReturnsNull()
    {
        $mock = $this->getMock(ASTNode::class);
        $node = new ASTNode($mock, __FILE__);

        $this->assertNull($node->getFullQualifiedName());
    }
}
