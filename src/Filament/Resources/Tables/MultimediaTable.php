<?php

declare(strict_types=1);

namespace Misaf\VendraMultimedia\Filament\Resources\Tables;

use Awcodes\BadgeableColumn\Components\Badge;
use Awcodes\BadgeableColumn\Components\BadgeableColumn;
use Filament\Actions\ActionGroup;
use Filament\Actions\ViewAction;
use Filament\Support\Enums\Size;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\Column;
use Filament\Tables\Columns\ColumnGroup;
use Filament\Tables\Columns\Layout\Component as LayoutComponent;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\QueryBuilder;
use Filament\Tables\Filters\QueryBuilder\Constraints\DateConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\TextConstraint;
use Filament\Tables\Table;
use Illuminate\Support\Number;
use Misaf\VendraMultimedia\Models\Multimedia;

final class MultimediaTable
{
    public static function configure(Table $table): Table
    {
        /**
         * @var array<int, Column|ColumnGroup|LayoutComponent> $columns
         */
        $columns = [
            TextColumn::make('row')
                ->label('#')
                ->rowIndex(),

            BadgeableColumn::make('model_type')
                ->alignStart()
                ->label(__('vendra-multimedia::tables.model_type'))
                ->suffixBadges([
                    Badge::make('count')
                        ->label(fn(Multimedia $record): string => Number::format((int) $record->model_id) ?: '0')
                        ->size(Size::Small),
                ]),

            TextColumn::make('uuid')
                ->alignStart()
                ->badge()
                ->label(__('vendra-multimedia::tables.uuid')),

            BadgeableColumn::make('collection_name')
                ->alignCenter()
                ->description(fn(Multimedia $record): string => $record->name)
                ->icon(Heroicon::QueueList)
                ->label(__('vendra-multimedia::tables.collection_name'))
                ->searchable()
                ->sortable(),

            TextColumn::make('batch_uuid')
                ->alignStart()
                ->label(__('vendra-multimedia::tables.batch_uuid')),

            TextColumn::make('created_at')
                ->alignCenter()
                ->badge()
                ->extraCellAttributes(['dir' => 'ltr'])
                ->label(__('vendra-multimedia::tables.created_at'))
                ->sinceTooltip()
                ->toggleable(isToggledHiddenByDefault: true)
                ->unless(
                    app()->isLocale('fa'),
                    fn(TextColumn $column) => $column->jalaliDateTime('Y-m-d H:i', latinNumbers: true),
                    fn(TextColumn $column) => $column->dateTime('Y-m-d H:i')
                ),

            TextColumn::make('updated_at')
                ->alignCenter()
                ->badge()
                ->extraCellAttributes(['dir' => 'ltr'])
                ->label(__('vendra-multimedia::tables.updated_at'))
                ->sinceTooltip()
                ->toggleable(isToggledHiddenByDefault: true)
                ->unless(
                    app()->isLocale('fa'),
                    fn(TextColumn $column) => $column->jalaliDateTime('Y-m-d H:i', latinNumbers: true),
                    fn(TextColumn $column) => $column->dateTime('Y-m-d H:i')
                ),
        ];

        return $table
            ->columns($columns)
            ->filters(
                [
                    QueryBuilder::make()
                        ->constraints([
                            TextConstraint::make('event')
                                ->label(__('vendra-multimedia::attributes.event')),

                            TextConstraint::make('log_name')
                                ->label(__('vendra-multimedia::attributes.log_name')),

                            TextConstraint::make('subject_type')
                                ->label(__('vendra-multimedia::attributes.subject_type')),

                            TextConstraint::make('causer_type')
                                ->label(__('vendra-multimedia::attributes.causer_type')),

                            TextConstraint::make('batch_uuid')
                                ->label(__('vendra-multimedia::attributes.batch_uuid')),

                            DateConstraint::make('created_at')
                                ->label(__('vendra-multimedia::attributes.created_at')),

                            DateConstraint::make('updated_at')
                                ->label(__('vendra-multimedia::attributes.updated_at')),
                        ]),
                ],
                layout: FiltersLayout::AboveContentCollapsible,
            )
            ->recordActions([
                ActionGroup::make([
                    ViewAction::make(),
                ]),
            ])
            ->defaultSort(column: 'id', direction: 'desc');
    }
}
