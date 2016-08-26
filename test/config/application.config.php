<?php

/**
 * MNHcC/ExtendedZendRoutes https://github.com/MNHcC/Zend3bcHelper
 *
 * @link      https://github.com/MNHcC/ExtendedZendRoutes for the canonical source repository
 * @author MNHcC  - Michael Hegenbarth (carschrotter) <mnh@mn-hegenbarth.de>
 * @copyright 2015-2016, MNHcC  - Michael Hegenbarth (carschrotter) <mnh@mn-hegenbarth.de>
 * @license BSD
 */

namespace MNHcC\ExtendedZendRoutes\TESTING {

// use the namespace of modules 
    use MNHcC;
    use MNHcC\Zend3bcHelper;
    use MNHcC\ExtendedZendRoutes;

return [
        'modules' => [
            Zend3bcHelper::class,
            MNHcC::class,
            ExtendedZendRoutes::class,
        ],
        // These are various options for the listeners attached to the ModuleManager
        'module_listener_options' => [
            // This should be an array of paths in which modules reside.
            // If a string key is provided, the listener will consider that a module
            // namespace, the value of that key the specific path to that module's
            // Module class.
            'module_paths' => [
                '../../vendor',
            ],
        ],
    ];
}