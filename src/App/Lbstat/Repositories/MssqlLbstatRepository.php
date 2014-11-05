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

	public function test()
	{
		return $this->db->query("
			-- By Date/Server
			-- Total clicks/size/speed per server per day
			-- Three area graphs, one for clicks, size and speed
			-- This is the main metric we can use to watch server performance
			-- If this slowly decreases, we are increasing server capacity or making pages more efficient
			SELECT
			date, server, sum(clicks) as totalClicks, avg(avg_size) as avgPageSize, avg(avg_speed) as avgPageSpeed
			FROM [Utility].[dbo].[tbl_stat_lb_pages]
			WHERE [date] BETWEEN DATEADD(mm, -6, getdate()) AND getdate()
			group by date, server
			order by server, date
		")->get();
	}


}