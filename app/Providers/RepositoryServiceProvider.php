<?php

namespace App\Providers;

use App\Models\SubArea;
use App\Models\LoanAdjustment;
use App\Repository\Repos\HubRepo;
use App\Repository\Repos\AreaRepo;
use App\Repository\Repos\BankRepo;
use App\Repository\Repos\FileRepo;
use App\Repository\Repos\LoanRepo;
use App\Repository\Repos\RoleRepo;
use App\Repository\Repos\AdminRepo;
use App\Repository\Repos\RiderRepo;
use App\Repository\Repos\ParcelRepo;
use App\Repository\Repos\ReasonRepo;
use App\Repository\Repos\WeightRepo;
use App\Repository\Repos\AdvanceRepo;
use App\Repository\Repos\BadDebtRepo;
use App\Repository\Repos\InvoiceRepo;
use App\Repository\Repos\SubAreaRepo;
use App\Repository\Repos\CityTypeRepo;
use App\Repository\Repos\LocationRepo;
use App\Repository\Repos\MerchantRepo;
use App\Repository\Repos\ComplaintRepo;
use Illuminate\Support\ServiceProvider;
use App\Repository\Repos\AssignAreaRepo;
use App\Repository\Repos\CollectionRepo;
use App\Repository\Repos\ParcelNoteRepo;
use App\Repository\Repos\ParcelTimeRepo;
use App\Repository\Repos\ParcelTypeRepo;
use App\Repository\Repos\PermissionRepo;
use App\Repository\Repos\ExpenseHeadRepo;
use App\Repository\Repos\MerchantBankRepo;
use App\Repository\Interfaces\HubInterface;
use App\Repository\Repos\BadDebtAdjustRepo;
use App\Repository\Repos\CancleInvoiceRepo;
use App\Repository\Repos\ExpenseRepository;
use App\Repository\Repos\PaymentMethodRepo;
use App\Repository\Repos\PickupRequestRepo;
use App\Repository\Repos\StatusMeaningRepo;
use App\Repository\Interfaces\AreaInterface;
use App\Repository\Interfaces\BankInterface;
use App\Repository\Interfaces\FileInterface;
use App\Repository\Interfaces\LoanInterface;
use App\Repository\Interfaces\RoleInterface;
use App\Repository\Repos\DeliveryChargeRepo;
use App\Repository\Repos\LoanAdjustmentRepo;
use App\Repository\Repos\ParcelTransferRepo;
use App\Repository\Interfaces\AdminInterface;
use App\Repository\Interfaces\RiderInterface;
use App\Repository\Repos\RiderCollectionRepo;
use App\Repository\Interfaces\ParcelInterface;
use App\Repository\Interfaces\ReasonInterface;
use App\Repository\Interfaces\AdvanceInterface;
use App\Repository\Interfaces\BadDebtInterface;
use App\Repository\Interfaces\ExpenseInterface;
use App\Repository\Interfaces\InvoiceInterface;
use App\Repository\Interfaces\SubAreaInterface;
use App\Repository\Interfaces\CityTypeInterface;
use App\Repository\Interfaces\LocationInterface;
use App\Repository\Interfaces\MerchantInterface;
use App\Repository\Interfaces\ComplaintInterface;
use App\Repository\Repos\MerchantBankAccountRepo;
use App\Repository\Interfaces\AssignAreaInterface;
use App\Repository\Interfaces\CollectionInterface;
use App\Repository\Interfaces\ParcelNoteInterface;
use App\Repository\Interfaces\ParcelTimeInterface;
use App\Repository\Interfaces\ParcelTypeInterface;
use App\Repository\Interfaces\PermissionInterface;
use App\Repository\Repos\MerchantPickupMethodRepo;
use App\Repository\Interfaces\ExpenseHeadInterface;
use App\Repository\Interfaces\WeightRangeInterface;
use App\Repository\Repos\MerchantMobileBankingRepo;
use App\Repository\Interfaces\MerchantBankInterface;
use App\Repository\Interfaces\BadDebtAdjustInterface;
use App\Repository\Interfaces\CancleInvoiceInterface;
use App\Repository\Interfaces\PaymentMethodInterface;
use App\Repository\Interfaces\PickupRequestInterface;
use App\Repository\Interfaces\StatusMeaningInterface;
use App\Repository\Repos\MobileBankingCollectionRepo;
use App\Repository\Interfaces\DeliveryChargeInterface;
use App\Repository\Interfaces\LoanAdjustmentInterface;
use App\Repository\Interfaces\ParcelTransferInterface;
use App\Repository\Interfaces\RiderCollectionInterface;
use App\Repository\Interfaces\MerchantBankAccountInterface;
use App\Repository\Interfaces\MerchantPickupMethodInterface;
use App\Repository\Interfaces\MerchantMobileBankingInterface;
use App\Repository\Interfaces\MobileBankingCollectionInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(
            AdminInterface::class,
            AdminRepo::class
        );
        $this->app->bind(
            BankInterface::class,
            BankRepo::class
        );
        $this->app->bind(
            CityTypeInterface::class,
            CityTypeRepo::class
        );
        $this->app->bind(
            AreaInterface::class,
            AreaRepo::class
        );
        $this->app->bind(
            SubAreaInterface::class,
            SubAreaRepo::class
        );
        $this->app->bind(
            LocationInterface::class,
            LocationRepo::class
        );
        $this->app->bind(
            ParcelTypeInterface::class,
            ParcelTypeRepo::class
        );
        $this->app->bind(
            MerchantInterface::class,
            MerchantRepo::class
        );
        $this->app->bind(
            WeightRangeInterface::class,
            WeightRepo::class
        );
        $this->app->bind(
            HubInterface::class,
            HubRepo::class
        );
        $this->app->bind(
            RiderInterface::class,
            RiderRepo::class
        );
        $this->app->bind(
            DeliveryChargeInterface::class,
            DeliveryChargeRepo::class
        );
        $this->app->bind(
            ParcelInterface::class,
            ParcelRepo::class
        );
        $this->app->bind(
            PickupRequestInterface::class,
            PickupRequestRepo::class
        );
        $this->app->bind(
            MerchantPickupMethodInterface::class,
            MerchantPickupMethodRepo::class
        );
        $this->app->bind(
            PaymentMethodInterface::class,
            PaymentMethodRepo::class
        );
        $this->app->bind(
            MerchantBankAccountInterface::class,
            MerchantBankAccountRepo::class
        );
        $this->app->bind(
            ReasonInterface::class,
            ReasonRepo::class
        );
        $this->app->bind(
            ExpenseInterface::class,
            ExpenseRepository::class
        );
        $this->app->bind(
            CollectionInterface::class,
            CollectionRepo::class
        );
        $this->app->bind(
            InvoiceInterface::class,
            InvoiceRepo::class
        );

        $this->app->bind(
            RiderCollectionInterface::class,
            RiderCollectionRepo::class
        );
        $this->app->bind(
            ExpenseHeadInterface::class,
            ExpenseHeadRepo::class
        );
        $this->app->bind(
            AssignAreaInterface::class,
            AssignAreaRepo::class
        );
        $this->app->bind(
            MerchantMobileBankingInterface::class,
            MerchantMobileBankingRepo::class
        );
        $this->app->bind(
            MerchantBankInterface::class,
            MerchantBankRepo::class
        );
        $this->app->bind(
            MobileBankingCollectionInterface::class,
            MobileBankingCollectionRepo::class
        );
        $this->app->bind(
            ParcelTimeInterface::class,
            ParcelTimeRepo::class
        );
        $this->app->bind(
            FileInterface::class,
            FileRepo::class
        );
        $this->app->bind(
            ParcelTransferInterface::class,
            ParcelTransferRepo::class
        );
        $this->app->bind(
            AdvanceInterface::class,
            AdvanceRepo::class
        );

        $this->app->bind(
            ParcelNoteInterface::class,
            ParcelNoteRepo::class
        );

        $this->app->bind(
            LoanInterface::class,
            LoanRepo::class
        );

        $this->app->bind(
            LoanAdjustmentInterface::class,
            LoanAdjustmentRepo::class
        );
        $this->app->bind(
            PermissionInterface::class,
            PermissionRepo::class
        );
        $this->app->bind(
            RoleInterface::class,
            RoleRepo::class
        );
        $this->app->bind(
            BadDebtInterface::class,
            BadDebtRepo::class
        );
        $this->app->bind(
            BadDebtAdjustInterface::class,
            BadDebtAdjustRepo::class
        );
        $this->app->bind(
            StatusMeaningInterface::class,
            StatusMeaningRepo::class
        );
        $this->app->bind(
            CancleInvoiceInterface::class,
            CancleInvoiceRepo::class
        );
        $this->app->bind(
            ComplaintInterface::class,
            ComplaintRepo::class
        );

    }
}
