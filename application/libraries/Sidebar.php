<?php
/**
 * Dynamically generates the markup for a sidebar navigation list.
 */
class Sidebar
{
    /**
     * Get the sidebar nav markup.
     *
     * @param   array   $list
     * @param   string  $active
     * @return  string
     */
    public static function get($list, $active = null)
    {
        $str = '<ul class="side-nav">';
        $active_str = '';
        foreach ($list as $k => $v)
        {
            if ($v == '-') {
                $str .= '<li class="divider"></li>';
            } else {
                if ($k == $active) $active_str = ' class="active"';
                $str .= '<li'.$active_str.'><a href="'.URL::to($v).'">'.$k.'</a></li>';
                $active_str = '';
            }
        }

        $str .= '</ul>';
        return $str;
    }

    public static function getCampuses($active = '')
    {
        $nav = array(
	        'Campuses' => 'campuses',
	        'Regions' => 'regions'
	    );
	    return static::get($nav, $active);
    }

    public static function getCampus($campus, $active = '')
    {
        $intakes_path = 'campuses/'.$campus->slug;
        $nav = array(
            'Intakes' => $intakes_path,
            '-',
            'Stats' => '#'
        );
        return static::get($nav, $active);
    }

    public static function getIntake($campus, $intake, $active = '')
    {
        $intake_path = 'campuses/'.$campus->slug.'/'.$intake->slug;
        $assignments_path = $intake_path.'/assignments';
        $nationalities_path = $intake_path.'/nationalities';
        $genders_path = $intake_path.'/genders';
        $ages_path = $intake_path.'/ages';

        $nav = array(
            'Students' => $intake_path,
            'Assignments' => $assignments_path,
            '-',
            'Ages' => $ages_path,
            'Nationalities' => $nationalities_path,
            'Genders' => $genders_path,
        );
        return static::get($nav, $active);
    }

    public static function getStudent($campus, $intake, $student, $active = '')
    {
        $nav = array(
            'Assignments' => '#',
            'Attendance' => '#'
        );
        return static::get($nav, $active);
    }
}
