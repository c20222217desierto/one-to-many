<?php 

namespace App\Filament\Resources\PostResource\Pages;

use App\Filament\Resources\PostResource;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Resources\Pages\ViewRecord;
use Filament\Actions;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Support\Enums\Alignment;

class ViewPost extends ViewRecord
{
    protected static string $resource = PostResource::class;

    public function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make()
                ->icon('heroicon-s-pencil-square')
                ->label('Edit Post'),
            Actions\ActionGroup::make([
                Actions\DeleteAction::make(),
            ])
         
        ];
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Post Details')
                    
                    ->schema([
                    TextEntry::make('title')
                        ->label('')
                        ->size('lg')
                      
                        ->color('primary'),
                       
                    TextEntry::make('body')
                        
                        ->label('')
                        ->size('md')
                      
                        
                ])
                    ->columns(1),

                Section::make('Comments')
                    ->description('Comment na mga epal sa post, ano pa ginahulat nyo? Comment na!')
                    ->schema([
                        RepeatableEntry::make('comments')
                            ->label('')
                            ->schema([
                                TextEntry::make('comment_body')
                                    ->icon('heroicon-o-chat-bubble-bottom-center-text')
                                    ->iconColor('primary')
                                    ->label('Comment')
                                    ->size('md'),
                                    
                            ])
                    ])
                    ->collapsible()
                    ->columns(2),
            ]);
    }
}