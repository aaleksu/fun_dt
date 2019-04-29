<?php

namespace ForFun\FunDt;

class FunDt
{
	private $startDt = null;

	private $nationalHolidays = [];

	public function __construct(
		\DateTime $startDt = null,
		array $nationalHolidays = []
	)
	{
		$this->startDt = $startDt ?? new \DateTime();
		$this->nationalHolidays = $nationalHolidays;
	}

	public function dtInWorkDays(int $workDaysNum)
	{
		for($i = 0; $i < $workDaysNum; $i++) {
			$this->startDt->modify('+1 day');
			if(in_array($this->startDt->format('D'), ['Sat', 'Sun'])
			   || in_array($this->startDt->format('m-d'), $this->nationalHolidays)
			) {
				$workDaysNum++;
			}
		}

		return $this->startDt;
	}

	public function setStartDt(\DateTime $startDt) : self
	{
		$this->startDt = $startDt;

		return $this;
	}

	public function setNationalHolidays(array $nationalHolidays) : self
	{
		$this->nationalHolidays = $nationalHolidays;

		return $this;
	}

	public function help()
	{
		return file_get_contents(__DIR__ . '/../README.md');
	}
}

