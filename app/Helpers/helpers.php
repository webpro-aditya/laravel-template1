<?php



if (!function_exists('getTerms')) {
   function getTerms()
   {
        $terms = [
            'day' => 'Daily',
            'month' => 'Monthly',
            'week' => 'Weekly',
            'year' => 'Yearly'
        ];

        return $terms;
   }
}


if (!function_exists('getDateFormatted')) {
    /**
     * Get the database date format from config.
     * This date format will be used to filter data from database
     *
     * @return date
     */
    function getDateFormatted($date, $format = 'Y-m-Y')
    {
        $dateFormatted = date($format, strtotime($date));
        return $dateFormatted;
    }
}

