<?php namespace App\Lbstat\Repositories;

interface LbstatRepositoryInterface
{

	public function getClicksByDateServer($drange);

	public function getPageSizeByDateServer($drange);

	public function getPageSpeedByDateServer($drange);

}