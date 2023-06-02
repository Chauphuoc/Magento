<?php
namespace Snaptec\Test\Setup;

use Magento\Framework\Setup\{
    ModuleContextInterface,
    ModuleDataSetupInterface,
    InstallDataInterface
};

use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;

class InstallData implements InstallDataInterface
{
    private $eavSetupFactory;

    public function __construct(EavSetupFactory $eavSetupFactory) {
        $this->eavSetupFactory = $eavSetupFactory;
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
        $eavSetup->addAttribute(\Magento\Catalog\Model\Category::ENTITY, 'mp_new_attribute', 'category_image',[
                'type'         => 'varchar',
				'label'        => 'Mageplaza Attribute',
				'input'        => 'text',
				'sort_order'   => 420,
				'source'       => '',
				'global'       => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
				'visible'      => true,
				'required'     => false,
				'user_defined' => false,
				'default'      => null,
				'group'        => 'Custom Attributes',
				'backend'      => ''
        ]);

        $eavSetup->addAttribute(\Magento\Catalog\Model\Product::ENTITY, 'brand_name',[
            'group'         => 'General',
            'type'        => 'varchar',
            'label'        => 'Brand Name',
            'input'   => 'select',
            'source'       => Source::class,
            'frontend'       => Frontend::class,
            'backend'      => Backend::class,
            'required'     => false,
            'sort_order' => 50,
            'global'      => ScopedAttributeInterface::SCOPE_GLOBAL,
            'is_used_in_grid'        => false,
            'is_visible_in_grid'      => false,
            'is_filterable_in_grid'  => false,
            'visible'         => true,
            'is_html_allowed_on_front' => true,
            'visible_on_front' => true
    ]);


    }


}
