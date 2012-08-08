<?php
class BreadCrumbs
{
    /**
     * Breadcrumbs for the region list page (/regions).
     *
     * @return string
     */
    public static function regionList()
    {
        return static::getCrumb('Home', '/');
    }
    
    /**
     * Breadcrumbs for the page of a single region(/regions/<region>).
     *
     * @return string
     */
    public static function regionSingle()
    {
        $crumbs = static::regionList();
        $crumbs .= static::getCrumb('Regions', 'regions');
        return $crumbs;
    }
    
    /**
     * Breadcrumbs for the campus list page (/campuses).
     *
     * @return string
     */
    public static function campusList()
    {
        return static::getCrumb('Home', '/');
    }
    
    /**
     * Breadcrumbs for the page of a single campus (/campuses/<campus>).
     *
     * @return string
     */
    public static function campusSingle()
    {
        $crumbs = static::campusList();
        $crumbs .= static::getCrumb('Campuses', 'campuses');
        return $crumbs;
    }
    
    /**
     * Breadcrumbs for the page of a single intake
     * (/campuses/<campus>/<intake>).
     *
     * @param   Campus  $campus
     * @return  string
     */
    public static function intakeSingle($campus)
    {
        $crumbs = static::campusSingle();
        $crumbs .= static::getCrumb($campus->name, "campuses/".$campus->slug);
        return $crumbs;
    }
    
    /**
     * Breadcrumbs for the assingments list page
     * (/campuses/<campus>/<intake>/assignments).
     *
     * @param   Campus  $campus
     * @return  string
     */
    public static function assignmentList($campus)
    {
        $crumbs = static::campusSingle();
        $crumbs .= static::getCrumb($campus->name, "campuses/".$campus->slug);
        return $crumbs;
    }
    
    /**
     * Breadcrumbs for the page of a single assignment
     * (/campuses/<campus>/<intake>/assignments/<assignment>).
     *
     * @param   Campus  $campus
     * @param   Intake  $intake
     * @return  string
     */
    public static function assignmentSingle($campus, $intake)
    {
        $crumbs = static::assignmentList($campus);
        $crumbs .= static::getCrumb($intake->name, "campuses/".$campus->slug."/".$intake->slug);
        $crumbs .= static::getCrumb('Assignments', "campuses/".$campus->slug."/".$intake->slug."/assignments");
        return $crumbs;
    }
    
    /**
     * Breadcrumbs for the page of a single student
     * (/campuses/<campus>/<intake>/<student>).
     *
     * @param   Campus  $campus
     * @param   Intake  $intake
     * @return  string
     */
    public static function studentSingle($campus, $intake)
    {
        $crumbs = static::intakeSingle($campus);
        $crumbs .= static::getCrumb($intake->name, "campuses/".$campus->slug."/".$intake->slug);
        return $crumbs;
    }

    /**
     * Generate a single bread crumb list item.
     *
     * @param   string  $name   link name
     * @param   string  $path   link path
     * @return  string
     */
    protected static function getCrumb($name, $path)
    {
        return "<li><a href=\"".URL::to($path)."\">$name</a></li>";
    }
}
