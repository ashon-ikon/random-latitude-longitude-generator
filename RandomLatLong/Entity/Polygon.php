<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace RandomLatLong\Entity;

use RandomLatLong\Artifact\Collection;
use RandomLatLong\Artifact\GeneratorException;
use RandomLatLong\Artifact\Location;

/**
 * Description of Polygon
 *
 * @author yinka
 */
class Polygon {
    
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
        $collection   =  new Collection([]);
        
        /* We are going to generate these point clockwise */
        for ($p = 1; $p <= $verts; $p++) {
            // Generate the "r" from this point
            $r          = mt_rand(1, 10) / 10; // Normalize to between 0, 1
            $currentAngle += $theta;
            $newLat     = $lat + ($r * cos($currentAngle) + $maxRadius);
            $newLng     = $long + ($r * sin($currentAngle) + $maxRadius);
            $collection->add(new Location($newLat, $newLng));
        }
        
        return $collection;
    }
    
    public static function getRotationMetrics(Collection $collection) {
        $total  = 0;
        $locations = array_values($collection->getAll());
        $count     = count($locations);
        if ($count > 1) {
            // We'll skip the first
            for ($i = 1; $i < $count; $i++) {
                /** @var Location Location  */
                $loc     = $locations[$i];
                /** @var Location Location  */
                $locLast = $locations[$i - 1];
                // x2 - x1 / (y2 + y1)
                $total   += ($loc->getLatitude() - $locLast->getLatitude()) / ($loc->getLongitude() + $locLast->getLongitude());
            }
        }
        return $total;
    }
}
