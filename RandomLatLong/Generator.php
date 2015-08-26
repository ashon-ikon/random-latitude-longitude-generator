<?php
/**
 * @package     Random Latitude Longitude
 * @author      Ashon <gigalimit20@yahoo.com>
 * @created     19-Aug-2015
 * 
 *   Zlib License
 * 
 * 
 *   This software is provided 'as-is', without any express or implied
 *  warranty.  In no event will the authors be held liable for any damages
 *  arising from the use of this software.
 * 
 *  Permission is granted to anyone to use this software for any purpose,
 *  including commercial applications, and to alter it and redistribute it
 *  freely, subject to the following restrictions:
 * 
 *   1. The origin of this software must not be misrepresented; you must not
 *     claim that you wrote the original software. If you use this software
 *     in a product, an acknowledgment in the product documentation would be
 *     appreciated but is not required.
 *  2. Altered source versions must be plainly marked as such, and must not be
 *     misrepresented as being the original software.
 *  3. This notice may not be removed or altered from any source distribution.
 * 
 *  http://www.gzip.org/zlib/zlib_license.html
 * 
 */
namespace RandomLatLong;

use RandomLatLong\Artifact\Collection;
use RandomLatLong\Artifact\GeneratorException;
use RandomLatLong\Artifact\Location;


/**
 * @method Collection makePolygon(t$lat, $long, $maxRadius = 1, $verts = 4, $openEnded = false) Makes polygon
 */

class Generator {
    
    
    /**
     *
     * @var Generator 
     */
    protected static $instance = null;
    
    /**
     * Private constructor
     */
    private function __construct() {}

    /**
     * This is the instance entry point
     * @return self
     */
    public static function getInstance()
    {
        if (null === static::$instance) {
            static::$instance = new self;
        }
        return static::$instance;
    }
    
    /**
     * Destroys the singleton
     */
    public static function selfDestroy()
    {
        if (static::$instance) {
            static::$instance = null;
        }
    }
    
    /*
     | 
     | Main functionalities
     | -------------------------------------------------------------
     */
    public function __call($name, $arguments) {
        if (false !== strpos($name, 'make')) {
            // Attempt to call the method
            $class = ucfirst(substr($name, 4));
            $classPath = __NAMESPACE__ . "\\Entity\\{$class}";
            $object = new $classPath();
            return call_user_method_array($name, $object, $arguments);
            
        } else {
            throw new GeneratorException(sprintf("Unknown method called! '%s'", (string) $name));
        }
    }

}
