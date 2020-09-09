<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|min:3',
            'slug' => 'required|min:3|unique:posts',
            'shortContent' => 'required|min:3',
            'content' => 'required|min:3',
            'seoTitle' => 'required|min:3',
        ];
    }
    public function messages()
    {
        return [
            'title.required'   => 'وارد کردن عنوان الزامی می باشد.',
            'title.min'   => 'حداقل عنوان 3 کاراکتر می باشد',
            'slug.min'   => 'حداقل نامک 3 کاراکتر می باشد',
            'slug.required'   => 'وارد کردن نامک الزامی می باشد.',
            'slug.unique'   => 'نامک از قبل وجود دارد',
            'shortContent.required'   => 'وارد کردن خلاصه الزامی می باشد.',
            'shortContent.min'   => 'حداقل خلاصه 3 کاراکتر می باشد',
            'content.required'   => 'وارد کردن توضیحات الزامی می باشد.',
            'content.min'   => 'حداقل توضیحات 3 کاراکتر می باشد',
            'seoTitle.required'   => 'وارد کردن عنوان سئو الزامی می باشد.',
            'seoTitle.min'   => 'حداقل عنوان سئو 3 کاراکتر می باشد',
            'stateName.required'   => 'وارد کردن استان الزامی می باشد.',
            'cityName.required'   => 'وارد کردن شهر الزامی می باشد.',
            'address.required'   => 'وارد آدرس الزامی می باشد.',
            'address.min'   => 'حداقل آدرس 5 کاراکتر می باشد',
            'phone.required'   => 'وارد تلفن الزامی می باشد.',
            'phone.digits'   => ' تلفن حداقل 8 رقم می باشد',
            'mobile.required'   => 'وارد موبایل الزامی می باشد.',
            'mobile.digits'   => 'شماره موبایل حداقل 11 رقم می باشد',
            'mobile.regex'   => 'شماره موبایل اشتباه است',
            'offPercent.required'   => 'وارد درصد تخفیف الزامی می باشد.',
            'endDate.required'   => 'وارد تاریخ اتمام تخفیف الزامی می باشد.',
            'timeStartA.required'   => 'وارد ساعت شروع شیفت صبح الزامی می باشد.',
            'timeEndA.required'   => 'وارد ساعت پایان شیفت صبح الزامی می باشد.',
            'timeStartB.required'   => 'وارد ساعت شروع شیفت ظهر الزامی می باشد.',
            'timeEndB.required'   => 'وارد ساعت پایان شیفت ظهر الزامی می باشد.',
        ];
    }
}
