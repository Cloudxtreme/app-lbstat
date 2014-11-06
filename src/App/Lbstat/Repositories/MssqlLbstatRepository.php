<?php namespace App\Lbstat\Repositories;

use Mreschke\Dbal\DbalInterface;

class MssqlLbstatRepository implements LbstatRepositoryInterface
{

	protected $db;

	public function __construct(DbalInterface $db)
	{
		$this->db = $db;
		$this->db->connection('dyna-sql6');
	}

	public function getClicksByDateServer($drange)
	{
		return $this->db->query("
			-- By Date/Server
			-- Total clicks per server per day
			-- Three area graphs, one for clicks, size and speed
			-- This is the main metric we can use to watch server performance
			-- If this slowly decreases, we are increasing server capacity or making pages more efficient
			SELECT CONVERT(VARCHAR(10), date, 7) AS [Mon DD],
				[1] AS SQL1, [2] AS SQL2, [3] AS SQL3, [4] AS SQL4, [5] AS SQL5, [6] AS SQL6
			FROM
				(SELECT date, server, clicks--, avg_size, avg_speed
				FROM [Utility].[dbo].[tbl_stat_lb_pages]
				WHERE [date] BETWEEN DATEADD(dd, -".$drange.", getdate()) AND getdate()) AS SourceTbl

			PIVOT
			(
				SUM(clicks)--, AVG(avg_size), AVG(avg_speed)
				FOR server IN ([1], [2], [3], [4], [5], [6])
			) AS PivotTable
			ORDER BY date
		")->get();
	}

	public function getPageSizeByDateServer($drange)
	{
		return $this->db->query("
			-- By Date/Server
			-- Total size per server per day
			-- Three area graphs, one for clicks, size and speed
			-- This is the main metric we can use to watch server performance
			-- If this slowly decreases, we are increasing server capacity or making pages more efficient
			SELECT date,
				[1] AS SQL1, [2] AS SQL2, [3] AS SQL3, [4] AS SQL4, [5] AS SQL5, [6] AS SQL6
			FROM
				(SELECT date, server, avg_size
				FROM [Utility].[dbo].[tbl_stat_lb_pages]
				WHERE [date] BETWEEN DATEADD(dd, -".$drange.", getdate()) AND getdate()) AS SourceTbl

			PIVOT
			(
				AVG(avg_size)
				FOR server IN ([1], [2], [3], [4], [5], [6])
			) AS PivotTable
			ORDER BY date
		")->get();
	}

	public function getPageSpeedByDateServer($drange)
	{
		return $this->db->query("
			-- By Date/Server
			-- Total speed per server per day
			-- Three area graphs, one for clicks, size and speed
			-- This is the main metric we can use to watch server performance
			-- If this slowly decreases, we are increasing server capacity or making pages more efficient
			SELECT date,
				[1] AS SQL1, [2] AS SQL2, [3] AS SQL3, [4] AS SQL4, [5] AS SQL5, [6] AS SQL6
			FROM
				(SELECT date, server, avg_speed
				FROM [Utility].[dbo].[tbl_stat_lb_pages]
				WHERE [date] BETWEEN DATEADD(dd, -".$drange.", getdate()) AND getdate()) AS SourceTbl

			PIVOT
			(
				AVG(avg_speed)
				FOR server IN ([1], [2], [3], [4], [5], [6])
			) AS PivotTable
			ORDER BY date
		")->get();
	}

}