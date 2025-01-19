<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrganizationInBoundingBoxRequest;
use App\Http\Requests\OrganizationInRadiusRequest;
use App\Http\Requests\OrganizationSearchRequest;
use App\Repositories\OrganizationRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    public function __construct(public OrganizationRepository $organizationRepository){}
    /**
     * @OA\Get(
     *     path="/api/organizations/building/{buildingId}",
     *     summary="Получить список организаций для конкретного здания",
     *     description="Возвращает все организации, находящиеся в указанном здании с пагинацией.",
     *     tags={"Organizations"},
     *     security={{"AuthorizationKey":{}}},
     *     @OA\Parameter(
     *         name="buildingId",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         required=false,
     *         @OA\Schema(type="integer", default=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Список организаций",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="current_page", type="integer"),
     *             @OA\Property(property="data", type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(property="id", type="integer"),
     *                     @OA\Property(property="name", type="string"),
     *                     @OA\Property(property="building_id", type="integer")
     *                 )
     *             ),
     *             @OA\Property(property="per_page", type="integer"),
     *             @OA\Property(property="total", type="integer")
     *         )
     *     ),
     *     @OA\Response(response=404, description="Здание не найдено"),
     * )
     */
    public function building(int $buildingId): JsonResponse
    {
        return response()->json($this->organizationRepository->inBuilding($buildingId));
    }

    /**
     * @OA\Get(
     *     path="/api/organizations/activity/{activityId}",
     *     summary="Получить ссписок всех организаций, которые относятся к указанному виду деятельности",
     *     description="Возвращает список всех организаций, которые относятся к указанному виду деятельности с пагинацией.",
     *     tags={"Organizations"},
     *     security={{"AuthorizationKey":{}}},
     *     @OA\Parameter(
     *         name="activityId",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         required=false,
     *         @OA\Schema(type="integer", default=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Список организаций",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="current_page", type="integer"),
     *             @OA\Property(property="data", type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(property="id", type="integer"),
     *                     @OA\Property(property="name", type="string"),
     *                     @OA\Property(property="building_id", type="integer")
     *                 )
     *             ),
     *             @OA\Property(property="per_page", type="integer"),
     *             @OA\Property(property="total", type="integer")
     *         )
     *     ),
     *     @OA\Response(response=404, description="Здание не найдено"),
     * )
     */
    public function activity(int $activityId): JsonResponse
    {
        return response()->json($this->organizationRepository->byActivity($activityId));
    }

    /**
     * @OA\Get(
     *     path="/api/organizations/radius",
     *     summary="Получить список организаций в радиусе относительно заданной точки",
     *     description="Получает список организаций, которые находятся в указанном радиусе относительно заданных координат.",
     *     tags={"Organizations"},
     *     security={{"AuthorizationKey":{}}},
     *     @OA\Parameter(
     *         name="latitude",
     *         in="query",
     *         description="Широта точки",
     *         required=true,
     *         @OA\Schema(type="number", format="float", default=55.7558)
     *     ),
     *     @OA\Parameter(
     *         name="longitude",
     *         in="query",
     *         description="Долгота точки",
     *         required=true,
     *         @OA\Schema(type="number", format="float", default=37.6173)
     *     ),
     *     @OA\Parameter(
     *         name="radius",
     *         in="query",
     *         description="Радиус в метрах",
     *         required=true,
     *         @OA\Schema(type="number", format="float")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Список организаций",
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Ошибка валидации"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Внутренняя ошибка сервера"
     *     )
     * )
     */
    public function radius(OrganizationInRadiusRequest $request): JsonResponse
    {
        return response()->json($this->organizationRepository->inRadius($request->validated()));
    }

    /**
     * @OA\Get(
     *     path="/api/organizations/boundingBox",
     *     summary="Получить список организаций в прямоугольной области",
     *     description="Получает список организаций, которые находятся в заданном прямоугольной областие относительно заданных координат.",
     *     tags={"Organizations"},
     *     security={{"AuthorizationKey":{}}},
     *     @OA\Parameter(
     *         name="minLatitude",
     *         in="query",
     *         description="Долгота точки мин",
     *         required=true,
     *         @OA\Schema(type="number", format="float", default=55.0084)
     *     ),
     *     @OA\Parameter(
     *         name="minLongitude",
     *         in="query",
     *         description="Широта точки мин",
     *         required=true,
     *         @OA\Schema(type="number", format="float", default=30.3351)
     *     ),
     *     @OA\Parameter(
     *         name="maxLatitude",
     *         in="query",
     *         description="Долгота точки макс",
     *         required=true,
     *         @OA\Schema(type="number", format="float", default=60.9343)
     *     ),
     *     @OA\Parameter(
     *         name="maxLongitude",
     *         in="query",
     *         description="Широта точки макс",
     *         required=true,
     *         @OA\Schema(type="number", format="float", default=82.9357)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Список организаций",
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Ошибка валидации"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Внутренняя ошибка сервера"
     *     )
     * )
     */
    public function boundingBox(OrganizationInBoundingBoxRequest $request): JsonResponse
    {
        return response()->json($this->organizationRepository->inBoundingBox($request->validated()));
    }

    /**
     * @OA\Get(
     *     path="/api/organizations/{organizationId}",
     *     summary="вывод информации об организации по её идентификатору",
     *     description="Получает информацию об организации по её идентификатору",
     *     tags={"Organizations"},
     *     security={{"AuthorizationKey":{}}},
     *     @OA\Parameter(
     *         name="organizationId",
     *         in="path",
     *         description="идентификатор",
     *         required=true,
     *         @OA\Schema(type="number", format="float", default=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Список организаций",
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Ошибка валидации"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Внутренняя ошибка сервера"
     *     )
     * )
     */
    public function show($organizationId): JsonResponse
    {
        return response()->json($this->organizationRepository->show($organizationId));
    }

    /**
     * @OA\Get(
     *     path="/api/organizations/search",
     *     summary="поиск организации по виду деятельности или по названию",
     *     description="Получает информацию об организации",
     *     tags={"Organizations"},
     *     security={{"AuthorizationKey":{}}},
     *     @OA\Parameter(
     *         name="activity",
     *         in="query",
     *         description="деятельность",
     *         required=false,
     *         @OA\Schema(type="string", format="float", default="Еда")
     *     ),
     *     @OA\Parameter(
     *         name="name",
     *         in="query",
     *         description="организация",
     *         required=false,
     *         @OA\Schema(type="string", format="float")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Список организаций",
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Ошибка валидации"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Внутренняя ошибка сервера"
     *     )
     * )
     */
    public function search(OrganizationSearchRequest $request): JsonResponse
    {
        return response()->json($this->organizationRepository->search($request));
    }

}
