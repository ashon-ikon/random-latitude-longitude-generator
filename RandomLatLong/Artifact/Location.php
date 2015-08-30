<?php
/**
 * @package     Random Latitude Longitude
 * @author      Ashon <gigalimit20@yahoo.com>
 * @created     20-Aug-2015
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


class Location {

    /**
     * Longitude
     * @var floats
     */
    protected $longitude = 0.0;

    /**
     * Latitude
     * @var float 
     */
    protected $latitude  = 0.0;

    /**
     * Creates new location object
     * 
     * @param float $latitude
     * @param float $longitude
     */
    public function __construct($latitude, $longitude) {
        $this->setLatitude($latitude);
        $this->setLongitude($longitude);
    }

    /**
     * Returns the longitude
     * @return float
     */
    public function getLongitude() {
        return $this->longitude;
    }

    /**
     * Returns the latitude
     * @return float
     */
    public function getLatitude() {
        return $this->longitude;
    }

    /**
     * Sets the longitude
     * @param float $long
     * @return \RandomLatLong\Location
     */
    public function setLongitude($long) {
        if ($long && is_numeric($long)) {
            $this->longitude = $long;
        }
        return $this;
    }

    /**
     * Sets the latitude
     * @param float $lat
     * @return \RandomLatLong\Location
     */
    public function setLatitude($lat) {
        if ($lat && is_numeric($lat)) {
            $this->latitude = $lat;
        }
        return $this;
    }

    /**
     * Gets the current location
     * @param boolean $withComma
     * @return string
     */
    public function toString($withComma = false) {
        $delimiter  = " ";
        if ($withComma) {
            $delimiter = ", ";
        }
        return "{$this->latitude}{$delimiter}{$this->longitude}";
    }
    

    /**
     * Gets the current location
     * @param boolean $withComma
     * @return string
     */
    public function __toString() {
        return $this->toString();
    }

}
