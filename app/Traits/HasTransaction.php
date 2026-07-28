<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Throwable;

trait HasTransaction
{
    use HasResponse;

    public function handle(
        callable $handler,
        ?callable $successCallback = null,
        ?string $action = null
    ): JsonResponse {

        try {
            DB::beginTransaction();
            $data = $handler();

            DB::commit();
            if ($successCallback) {
                $response = $successCallback($data);
            } 
            else {
                $messages = match ($action) {
                    'store' => 'Data berhasil disimpan.',
                    'update' => 'Data berhasil diperbarui.',
                    'destroy' => 'Data berhasil dihapus.',
                    default => 'Berhasil.'
                };

                $response = self::response(
                    message: $messages,
                    success: true,
                    data: $data
                );
            }
            return response()->json($response);

        } catch (ValidationException $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Validation Error',
                'errors' => $e->errors(),
            ], 422);

        } catch (Throwable $e) {
            DB::rollBack();
            logger()->error($e);

            $message = app()->isProduction()
                ? 'Terjadi kesalahan.'
                : $e->getMessage();

            return response()->json(
                self::response($message, false),
                self::httpCode($e->getCode())
            );
        }
    }
}