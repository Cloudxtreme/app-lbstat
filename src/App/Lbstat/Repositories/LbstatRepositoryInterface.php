<?php namespace App\Lbstat\Repositories;

interface LbstatRepositoryInterface
{

	public function getClicksByDateServer($dateRange);

	public function getPageSizeByDateServer($dateRange);

	public function getPageSpeedByDateServer($dateRange);

}