<?php
/**
 * @package     Random Latitude Longitude
 * @author      Ashon <gigalimit20@yahoo.com>
 * @created     21-Aug-2015
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
namespace RandomLatLong\Artifact;

class Collection extends \ArrayIterator {
    
    protected $list     = [];
    
    /**
     * Adds a new collection
     * @param \RandomLatLong\Artifact\Location $loc
     * @return \RandomLatLong\Artifact\Collection
     */
    public function add(Location $loc) {
        $this->list[md5(time() + count($this->list))] = $loc;
        return $this;
    }
    
    /**
     * Size of collection
     * @return integer
     */
    public function size() {
        return count($this->list);
    }
    
    /**
     * Gets all locations
     * @return array List of lcations
     */
    public function getAll() {
        return $this->list;
    }
    
    public function getLocationsAsGeoCollection()
    {
        
    }
    
}
