<?php
namespace EzSystems\LandingPageBlockTemplateBundle\Block;

use EzSystems\LandingPageFieldTypeBundle\Exception\InvalidBlockAttributeException;
use EzSystems\LandingPageFieldTypeBundle\FieldType\LandingPage\Definition\BlockDefinition;
use EzSystems\LandingPageFieldTypeBundle\FieldType\LandingPage\Definition\BlockAttributeDefinition;
use EzSystems\LandingPageFieldTypeBundle\FieldType\LandingPage\Model\AbstractBlockType;
use EzSystems\LandingPageFieldTypeBundle\FieldType\LandingPage\Model\BlockValue;

/**
 * Template block
 * Template for Landing Page Field Type Block.
 */
class TemplateBlock extends AbstractBlockType
{
    /**
     * Returns the parameters to the template.
     * To retrieve block attributes call $blockValue->getAttributes()
     *
     * {@inheritdoc}
     */
    public function getTemplateParameters(BlockValue $blockValue)
    {
        return [
            'block' => json_encode($blockValue->getAttributes())
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function createBlockDefinition()
    {
        return new BlockDefinition(
            'template', // Block type (unique)
            'Template', // Name of block
            'default', // Block category (currently unsupported)
            'bundles/ezsystemslandingpagefieldtype/images/thumbnails/tag.svg', // icon for thumbnail
            [], // extra views that can be hardcoded
            [
                new BlockAttributeDefinition(
                    'templateContent', // Attribute's ID (unique)
                    'Content', // Attribute' name
                    'text', // Attribute's type
                            // Available options:
                            // - integer
                            // - string
                            // - url
                            // - text
                            // - embed
                            // - select
                            // - multiple
                    '/[^\\s]/', // regex for frontend validation
                    'Sample content', // regex validation fail message
                    true, // is field required?
                    false, // should this attribute input be displayed inline to the previous?
                    [], // default value
                    [] // available options (for select and multiple)
                ),
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function checkAttributesStructure(array $attributes)
    {
        if (!isset($attributes['templateContent'])) {
            throw new InvalidBlockAttributeException(
                $this->getBlockDefinition()->getName(),
                'templateContent',
                'Content must be set.'
            );
        }
    }
}
