<?php
/**
 * @package     Random Latitude Longitude
 * @author      Ashon <gigalimit20@yahoo.com>
 * @created     26-Aug-2015
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

namespace RandomLatLong\Entity;

use RandomLatLong\Artifact\Collection;

class Geometry {

    /**
     * Current collection of locations
     * @var Collection
     */
    protected $collection = null;

    /**
     * 
     * @param Collection $collection
     */
    public function __construct(Collection $collection = null) {
        $this->setCollections($collection);
    }
    
    /**
     * Gets the geometry's collection
     * @return Collection
     */
    public function getCollections() {
        return $this->collection;
    }

    /**
     * Sets the Geometry's collection
     * @param Collection $collection
     */
    public function setCollections(Collection $collection) {
        if ($collection->size()) {
            $this->collection = $collection;
        }
    }

}
