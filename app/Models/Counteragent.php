<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Counteragent
 *
 * @property int $id
 * @property int $counteragent_group_id
 * @property string $name
 * @property string|null $id_1c
 * @property string|null $bin
 * @property int $payment_type
 * @property int $price_type_id
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Counteragent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Counteragent newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Counteragent query()
 * @method static \Illuminate\Database\Eloquent\Builder|Counteragent whereBin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Counteragent whereCounteragentGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Counteragent whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Counteragent whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Counteragent whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Counteragent whereId1c($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Counteragent whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Counteragent wherePaymentType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Counteragent wherePriceTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Counteragent whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $payment_type_id
 * @property float|null $discount
 * @property int|null $enabled
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\CounteragentUser[] $counteragentUsers
 * @property-read int|null $counteragent_users_count
 * @property-read \App\Models\PaymentType $paymentType
 * @property-read \App\Models\PriceType $priceType
 * @method static \Illuminate\Database\Eloquent\Builder|Counteragent whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Counteragent whereEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Counteragent wherePaymentTypeId($value)
 */
class Counteragent extends Model
{
    use HasFactory;

    protected $fillable = ['id','name','id_1c','bin','payment_type_id','price_type_id','discount','enabled','created_at'];

    protected $hidden = ['deleted_at','created_at','updated_at','laravel_through_key'];

    function priceType():BelongsTo
    {
        return  $this->belongsTo(PriceType::class);
    }
    function paymentType():BelongsTo
    {
        return  $this->belongsTo(PaymentType::class);
    }
    function counteragentUsers():HasMany
    {
        return  $this->hasMany(CounteragentUser::class);
    }


}
