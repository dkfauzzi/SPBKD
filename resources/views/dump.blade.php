public function QuarterlyLineChart($year = null)
{
    // Fetch data from the database
    $data = $year
        ? QuarterDate::whereYear('start_date', '<=', $year)
            ->whereYear('end_date', '>=', $year)
            ->get()
        : QuarterDate::all();

    // Filter data for the specific year if a year is selected
    if ($year) {
        $data = $data->filter(function ($item) use ($year) {
            $startDateYear = Carbon::parse($item->start_date)->year;
            $endDateYear = Carbon::parse($item->end_date)->year;

            return $startDateYear == $year || $endDateYear == $year;
        });
    }

    // Organize data by year and quarter
    $chartData = $this->organizeQuarterlyData($data);

    // Retrieve distinct years from your data
    $distinctYears = $data->flatMap(function ($item) {
        return [$item->start_date, $item->end_date];
    })->map(function ($date) {
        return Carbon::parse($date)->year;
    })->unique()->sort()->values()->toArray();

    // Pass the data to the view or return it as needed
    return response()->json(['quarterlyChartData' => $chartData, 'distinct_years' => $distinctYears]);
}