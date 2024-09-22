<?php



namespace App\Traits;

trait SpendDetailsTrait
{
    public function calculateProfit($totalBudget, $totalSpending, $fixProfit)
    {
        if ($fixProfit == 0) {
            return '#error!';
        }

        $profit = (($totalBudget - $totalSpending) / $fixProfit) * 100;
        return number_format($profit, 2);
    }

    public function groupSpendDetails($spendDetails)
    {
        $groupedDetails = [];

        foreach ($spendDetails as $detail) {
            $groupedDetails[$detail->pmt_name][] = $detail;
        }

        return $groupedDetails;
    }
}




?>
