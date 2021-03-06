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

namespace Tests\RandomLatLong;

use RandomLatLong\Entity\Polygon;
use RandomLatLong\Generator;
use Tests\TestAbstract;

class TestGenerator extends TestAbstract {

    public function testMakingPolygonsWithDefaultValues() {
        $gen          = Generator::getInstance();
        $lat          = 101.428;
        $long         = -23.140;
        $maxRadius    = 2;
        $defaultVerts = 4;
        $collection   = $gen->makePolygon($lat, $long, $maxRadius);

        $this->assertEquals($defaultVerts, $collection->size(), 'Polygon vertices is NOT correct');
    }
    
    /**
     * Tests that the vertices make a valid clockwise polygon
     */
    public function testMakingPolygonsGeneratedAreClockwise() {
        $gen          = Generator::getInstance();
        $lat          = 101.428;
        $long         = -23.140;
        $maxRadius    = 1;
        $defaultVerts = 2;
        $collection   = $gen->makePolygon($lat, $long, $maxRadius, $defaultVerts);
        
        $this->assertTrue(0 > Polygon::getRotationMetrics($collection), 'Polygon generated is NOT clockwise');
    }
    
    

}
