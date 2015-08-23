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

use RandomLatLong\Artifact\GeneratorException;

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
    
    /**
     * Creates a polygon that stems from the latitude and longitude provided
     * 
     * @param integer $lat          Reference latitude in degrees
     * @param integer $long         Reference longitude in degrees
     * @param integer $maxRadius    Units away from the reference cordinates
     * @param integer $verts        Number of vertices required
     * @param boolean $openEnded    If true, the polygon is not closed
     * 
     * @return array List of polygon points
     */
    public function makePolygon($lat, $long, $maxRadius = 1, $verts = 4, $openEnded = false)
    {
        
        /* Ensure the vertices are more than 1 */
        if ($verts < 2) {
            throw new GeneratorException("The number of vertices specified is too low", GeneratorException::ERR_TOO_FEW_VERTICES);
        }
        
        $theta        = 360 / ($openEnded ? ($verts + 1) : $verts);
        $currentAngle = 0;
        $points       = [];
        $collection   =  new Artifact\Collection();
        /* We are going to generate these point clockwise */
        for ($p = 1; $p <= $verts; $p++) {
            $currentAngle += $theta;
            $newLng     = $long + (cos($currentAngle) * $maxRadius);
            $newLat     = $long + (sin($currentAngle) * $maxRadius);
            $collection->add(new Artifact\Location($newLat, $newLng));
        }
        return $collection;
    }

}
