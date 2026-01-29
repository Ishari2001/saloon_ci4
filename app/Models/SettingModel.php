<?php

namespace App\Models;

use CodeIgniter\Model;

class SettingModel extends Model
{
    protected $table      = 'settings';
    protected $primaryKey = 'id';
    protected $allowedFields = ['key', 'value', 'date', 'created_at', 'updated_at'];
    protected $useTimestamps = true; // auto handles created_at, updated_at

    /**
     * Get the setting value
     * If date is provided, check specific date first, fallback to default (date=null)
     */
    public function getValue($key, $date = null)
    {
        $builder = $this->where('key', $key);

        if ($date) {
            $builder->groupStart()
                    ->where('date', $date)
                    ->orWhere('date IS NULL', null, false)
                    ->groupEnd();
        }

        $setting = $builder->orderBy('date', 'DESC')->first();

        // Special case for full_day_closed: return boolean
        if ($setting && $key === 'full_day_closed') {
            return $setting['value'] === '1';
        }

        return $setting['value'] ?? null;
    }

    /**
     * Save or update setting
     */
    public function setValue($key, $value, $date = null)
    {
        $existing = $this->where('key', $key)
                         ->where('date', $date)
                         ->first();

        if ($existing) {
            return $this->update($existing['id'], ['value' => $value]);
        } else {
            return $this->insert(['key' => $key, 'value' => $value, 'date' => $date]);
        }
    }

    /**
     * Get all settings
     */
    public function allSettings()
    {
        return $this->orderBy('date', 'DESC')->findAll();
    }
}
