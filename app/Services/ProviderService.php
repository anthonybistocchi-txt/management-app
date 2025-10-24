<?

use App\Models\Provider;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProviderService
{
    public function createProvider(Request $request): Provider
    {
        $data = $request->validate([
            'name'             => 'required|string|max:255',
            'cnpj'             => 'required|string|max:21',
            'phone'            => 'nullable|string|max:20',
            'email'            => 'required|string|email|max:255|unique:users',
            'address_street'   => 'nullable|string|max:255',
            'address_number'   => 'nullable|string|max:20',
            'address_city'     => 'nullable|string|max:255',
            'address_state'    => 'nullable|string|max:2',
            'address_zipcode'  => 'nullable|string|max:10',
        ]);


        $provider = Provider::create($data);

        return $provider;
    }

    public function deleteProvider(array $data): bool
    {
        $provider = Provider::findOrFail($data['id']);

        if (!$provider) {
            return false;
        }

        $provider->is_active  = 0;
        $provider->deleted_at = now();

        return true;
    }

    public function updateProvider($id, Request $request): Provider
    {
        $provider = Provider::findOrFail($id);

        $data = $request->validate([
            'name'             => 'sometimes|string|max:255',
            'cnpj'             => 'sometimes|string|max:21',
            'phone'            => 'sometimes|string|max:20',
            'email'            => 'sometimes|string|email|max:255|unique:users',
            'is_active'        => 'sometimes|boolean',
            'address_street'   => 'sometimes|string|max:255',
            'address_number'   => 'sometimes|string|max:20',
            'address_city'     => 'sometimes|string|max:255',
            'address_state'    => 'sometimes|string|max:2',
            'address_zipcode'  => 'sometimes|string|max:10',
        ]);

        $provider->update($data);

        return $provider;
    }

    public function getProvider(string $data): Collection
    {
        $ids = explode(',', $data);
        $providers = Provider::whereIn('id', $ids)->get();
        return $providers;
    }

    public function getAllProviders(): array
    {
        $providers = Provider::where('is_active', '1')
            ->get()
            ->toArray();
        return $providers;
    }
}
